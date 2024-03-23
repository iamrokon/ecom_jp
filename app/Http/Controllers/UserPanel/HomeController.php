<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Session;
use Mail;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Product;
use App\Model\Product2;
use App\Model\Product3;
use App\Model\Kokyaku1;
use App\Model\Gazou;
use Storage; 
use DB;

class HomeController extends Controller
{
    public function index()
    {
        //set loaded route
        Session::put("last_loaded_route","homepage");
        
        $categories = Category::where('osusume', '=', 1)
            ->where('groupbango', '=', 1)
            ->whereNull('category1')
            ->where('category2','=','1')
            ->orderBy('suchi1','ASC')
            ->get();
        
        $recommended_products = Product::where('code1','=','1')
                                        ->where('endtime','=','1')
                                        ->where('isphoto','=','0')
                                        ->where('isdaihyou','=','1')
                                        ->join('gazou', 'gazou.syouhinbango', '=', 'syouhin1.bango')
                                        ->leftjoin('categorykanri as parent_category', DB::raw('syouhin1.data51::INTEGER'), '=', 'parent_category.bango')
                                        ->where('parent_category.category2','=','1')
                                        ->leftjoin('categorykanri as child_category', DB::raw('syouhin1.data52::INTEGER'), '=', 'child_category.bango')
                                        ->whereRaw("(CASE WHEN child_category.category2 is null THEN '1' ELSE child_category.category2 END) = '1'")
                                        ->select('syouhin1.bango','jouhou','mdjouhou','data23','gazou.url')
                                        ->get();
        return view('UserPanel.index_lightning',compact('categories','recommended_products'));
    }
    
    public function loadAuthenticationPage()
    {
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.loginRegister',compact('categories','brands')); 
    }
    
    public function loadAboutPage()
    {
        //set loaded route
        Session::put("last_loaded_route","about");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.about',compact('categories','brands')); 
    }
    
    public function companyProfile()
    {
        //set loaded route
        Session::put("last_loaded_route","companyProfile");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.companyProfile',compact('categories','brands')); 
    }
    
    public function companyProfileOne()
    {
        //set loaded route
        Session::put("last_loaded_route","companyProfileOne");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.companyProfileOne',compact('categories','brands')); 
    }
    
    public function fPrivacyPolicy()
    {
        //set loaded route
        Session::put("last_loaded_route","fPrivacyPolicy");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.fPrivacyPolicy',compact('categories','brands')); 
    }
    
    public function termsService()
    {
        //set loaded route
        Session::put("last_loaded_route","termsService");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.termsService',compact('categories','brands')); 
    }
    
    public function loadContactPage()
    {
        //set loaded route
        Session::put("last_loaded_route","contact");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.contact',compact('categories','brands')); 
    }
    
    public function loadPrivacyPolicyPage()
    {
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.privacyPolicy',compact('categories','brands')); 
    }
    
    public function loadTermsPage()
    {
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.terms',compact('categories','brands')); 
    }
    
    public function loadBrandList()
    {
        //set loaded route
        Session::put("last_loaded_route","brandList");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.brandList',compact('categories','brands')); 
    }
    
    public function contactMail(Request $request)
    {
        $request = $request->all();
        
        $rules=[];
        $rules['name'] = ['bail','required','max:70'];
        $rules['email'] = ['bail','required','email','max:90'];
        $rules['phone'] = ['bail','nullable','max:11'];
        if(!isset($request['page_name'])){
            $rules['subject'] = ['bail','required','max:1000'];
        }
        $rules['message'] = ['bail','required','max:5000'];

        $message=[];    
        $message['required']=':attribute必須項目に入力がありません。';
        $message['email']=':attributeは有効なメールアドレスである必要があります。';
        $message['max']=':attributeは:max文字を超えてはなりません。';

        $attributes = [
            'name' => '名前',
            'email' => 'メール',
            'phone' => '電話',
            'subject' => '件名',
            'message' => 'メッセージ',
        ];

        $validator = Validator::make($request,$rules,$message,$attributes); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }else{
            $kokyaku1 = Kokyaku1::select('name','mail_toiawase','tel')->where('bango',env('store'))->first();
            $email_subject = $request['subject'];
            $sender_name = $request['name'];
            $fromMail = $request['email'];
            $email_content = "Name: ".$request['name'].'<br><br>';
            $email_content .= "Subject: ".$request['subject'].'<br><br>';
            $email_content .= "Message: ".$request['message'];
            //$shop_title = $kokyaku1->name;
            $toMail = $kokyaku1->mail_toiawase;
            $phone = $request['phone']??"";
            
            //check mail type
            if (strpos($toMail, 'gmail') !== false) {
                $mail_type = 'gmail'; 
            }else{
                $mail_type = 'other';
            }
            
            //$tel = $kokyaku1->tel;
            //$site_url = url('/');
            //if ($mail_type == "gmail") {
            //    $mail_body_subject = $request['subject'] != '' ?'<p style="display:block;margin-top: 5px;">'.$request['subject'].'</p>'.'<br>':"";
            //}else{
            //    $mail_body_subject = $request['subject'] != '' ?'<p style="display:block;">'.$request['subject'].'</p>'.'<br><br><br>':"";
            //}
            //$phone = $request['phone']??"";
            //$message = '<p style="display:block;margin-top: 5px;">'.$request['message'].'</p>';
            //$file_name = 14 . '.json';
            //if (Storage::disk('mail')->exists($file_name)) 
            //{
            //    $contents = Storage::disk('mail')->get($file_name);
            //    $mail_data = json_decode($contents);
            //    $email_subject = $mail_data[0];
            //    $email_header = $mail_data[1];
            //    $body_content = "<div style='display:block;'>".str_replace('{{subject}}',$mail_body_subject,$mail_data[2])."</div>";
            //    $email_footer = str_replace('{{shop_phone}}',$tel,$mail_data[3]);
            //    $email_footer = str_replace('{{shop_title}}',$shop_title,$email_footer);
            //}else{ 
            //    $email_subject = "";
            //    $email_header = "";
            //    $body_content = "";
            //    $email_footer = "";
            //}
            //$email_content = str_replace('{{username}}',$sender_name,$email_header);
            //if ($mail_type != "gmail") {
            //    $email_content .= '<br><br>';
            //}
            //$email_content .= str_replace('{{contents}}',$message,$body_content);
            //$email_content .= str_replace('{{site_url}}',$site_url,$email_footer);
            
            Mail::send(new ContactMail($sender_name,$phone,$toMail,$fromMail,$email_subject,$email_content));
            if (count(Mail::failures()) > 0) {
                return "ng";
            }else{
                if(!isset($request['page_name'])){
                    Session::flash("success_mail","お問い合わせいただき、ありがとうございます。内容を確認後、早急にご返信させて頂きます。");
                }
                return "ok";
            }
            
        }
    }
    
    
}