<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Session;
use Storage; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Kokyaku1;
use Mail;
use App\Mail\ContactMail;

class MailController extends Controller
{
    public static $MAIL_ARRAY = [
                                    '1' => '受注メール',
                                    '7' => 'パスワード再発行メール',
                                    '14' => '問合せ完了'
                                ];

	public function index(Request $request)
	{
        $pageType = request('pageType');
        $mails=\DB::table('kokyaku1')->where('bango',env('store'))->first();
	    return view('Admin.Settings.Email.index',compact('mails','pageType'));
	}

	public function edit($mail_id)
    {
        $file_name = $mail_id . '.json';
        $default_file_name = 'default/'. $mail_id . '.json';
        $mail_array = self::$MAIL_ARRAY;
        
        if (Storage::disk('mail')->exists($default_file_name)) 
        {
            $contents = Storage::disk('mail')->get($default_file_name);
            $reset_mail_data = json_decode($contents);
        }
        else $reset_mail_data = [ NULL , NULL , NULL , NULL ];

        if (Storage::disk('mail')->exists($file_name)) 
        {
            $contents = Storage::disk('mail')->get($file_name);
            $mail_data = json_decode($contents);
        }
        else if (Storage::disk('mail')->exists($default_file_name)) 
        {
            $mail_data = $reset_mail_data;
        }
        else $mail_data = [ NULL , NULL , NULL , NULL ];
        return view('Admin.Settings.Email.edit', compact('mail_id','mail_array','mail_data','reset_mail_data'));
    }

    public function update($mail_id)
    {
        $file_name = $mail_id . '.json';
        
        $array = [ request('subject') , request('header') , request('fixed_text') , request('footer') ];
        $file_path = Storage::disk('mail')->getAdapter()->getPathPrefix();
        if (!file_exists($file_path)) 
        {
            mkdir($file_path, 0777, true);
        }
        Storage::disk('mail')->put($file_name, json_encode($array));
        $message = '更新しました。';
        
        return redirect()->back()->with('status', $message);
    }

    public function mailsetup(Request $request)
    {
        $pageType = "";
        
        $message=[];    
        $message['required']='【:attribute】必須項目に入力がありません。';
        $message['email']='【:attribute】有効なメールアドレスを入力してください。';
        $message['max']='【:attribute】は:max文字を超えてはなりません。';

        $attributes = [
            'mail1' => '送信元メールアドレス',
            'mail2' => '問い合わせ受付メールアドレス',
            'mail3' => '注文受付メールアドレス',
        ];
        
        $validator = Validator::make(request()->all(), [
            'mail1' => 'required|email|max:100',
            'mail2' => 'required|email|max:100',
            'mail3' => 'required|email|max:100',
        ],$message,$attributes);

        $errors = $validator->errors();
        
        if ($errors->messages()) {
          $err_fields = $errors->messages();
          return view('Admin.Settings.Email.index',compact('errors','err_fields','pageType'));
        }

        \DB::table('kokyaku1')->where('bango',env('store'))->update([
            'mail_soushin'=>request('mail1'),
            'mail_toiawase'=>request('mail2'),
            'mail_soushin_mb'=>request('mail3')
        ]);

        //return redirect()->back()->with('status', 'successfully edited');  
        $mails=\DB::table('kokyaku1')->where('bango',env('store'))->first(); 
	return view('Admin.Settings.Email.index',compact('mails','pageType'));
    }

    public function testMail(Request $request,$format_id)
    {
        $kokyaku1 = Kokyaku1::select('name','mail_toiawase','tel')->where('bango',env('store'))->first();
        return view('Admin.test_mail',compact('kokyaku1','format_id'));
    }
    public function sendMail(Request $request)
    {
        $request = $request->all();
        $kokyaku1 = Kokyaku1::select('name','mail_toiawase','tel')->where('bango',env('store'))->first();
        
        $rules=[];
        $rules['email'] = ['bail','required','email','max:90'];

        $message=[];    
        $message['required']='【:attribute】必須項目に入力がありません。';
        $message['email']='【:attribute】有効なメールアドレスを入力してください。';
        $message['max']=':attributeは:max文字を超えてはなりません。';

        $attributes = [
            'email' => 'メールアドレス',
        ];

        $validate = Validator::make($request,$rules,$message,$attributes); 
        if($validate->fails()){ 
            return redirect()->back()->withErrors($validate->messages())->withInput();
        }else{
            $kokyaku1 = Kokyaku1::select('name','mail_toiawase','mail_soushin','tel')->where('bango',env('store'))->first();
            $header_sender_name = $request['fname'].' '.$request['lname'];
            $sender_name = $kokyaku1->name;
            if($request['format_id'] == 1){
                $fromMail = $kokyaku1->mail_soushin;
            }else{
                $fromMail = $kokyaku1->mail_toiawase;
            }
            $shop_title = $kokyaku1->name;
            $toMail = $request['email'];
            
            //check mail type
            if (strpos($toMail, 'gmail') !== false) {
                $mail_type = 'gmail'; 
            }else{
                $mail_type = 'other';
            }
            
            $tel = $kokyaku1->tel;
            $site_url = url('/');
            if ($mail_type == "gmail") {
                $mail_body_subject = '<p style="display:block;margin-top: 5px;">Test Subject</p>'.'<br>';
            }else{
                $mail_body_subject = '<p style="display:block;">Test Subject</p>'.'<br><br><br>';
            }
            $phone = $request['phone']??"";
            $message = '<p style="display:block;margin-top: 5px;">Test Message</p>';
            
            $file_name = $request['format_id'] . '.json';   
            
            if (Storage::disk('mail')->exists($file_name)) 
            {
                $contents = Storage::disk('mail')->get($file_name);
                $mail_data = json_decode($contents);
                $email_subject = $mail_data[0];
                $email_header = str_replace('{{shop_title}}',$shop_title,$mail_data[1]);
                if($request['format_id'] == 1){
                    $body_content = "<div style='display:block;'>".str_replace('配送内容','配送内容 <br>',$mail_data[2])."</div>";
                    $body_content = str_replace('ご購入日','<br> ご購入日',$body_content);
                    $body_content = str_replace('決済方法','<br> 決済方法',$body_content);
                    $body_content = str_replace('お届け希望日','<br> お届け希望日',$body_content);
                    $body_content = str_replace('お届け指定時間','<br> お届け指定時間',$body_content);
                    $body_content = str_replace('納品書の価格表示','<br> 納品書の価格表示',$body_content);
                    $body_content = str_replace('その他お問い合わせ内容','<br> その他お問い合わせ内容',$body_content);
                    $body_content = str_replace('{{message}}','{{message}}<br>',$body_content);
                    $body_content = str_replace('ご購入内容','<br> ご購入内容 <br>',$body_content);
                    $body_content = str_replace('注文番号','<br> 注文番号',$body_content);
                    $body_content = str_replace('商 品 名','<br><br> 商 品 名',$body_content);
                    $body_content = str_replace('品    番','<br> 品    番',$body_content);
                    $body_content = str_replace('数　　量','<br> 数　　量',$body_content);
                    $body_content = str_replace('購入価格 :[MiSyukko.Kingaku] 円','<br> 購入価格 :[MiSyukko.Kingaku] 円 <br>',$body_content);
                    $body_content = str_replace('商品代金合計 [購入価格の合計] 円','<br> 商品代金合計 [購入価格の合計] 円 <br>',$body_content);
                    $body_content = str_replace('代引き手数料 [TuhanOrder.Money1] 円','<br> 代引き手数料 [TuhanOrder.Money1] 円 <br>',$body_content);
                    $body_content = str_replace('金額合計 :[TuhanOrder.MoneyMax] 円','<br> 金額合計 :[TuhanOrder.MoneyMax] 円 <br>',$body_content);
                    $body_content = str_replace('ご購入者様情報','<br> ご購入者様情報 <br>',$body_content);
                    $body_content = str_replace('[メールアドレス］　{{mail_address}}','<br> [メールアドレス］　{{mail_address}} <br>',$body_content);
                    $body_content = str_replace('お届け先情報','<br> お届け先情報 <br>',$body_content);
                    $body_content = str_replace('[お　名　前］','<br> [お　名　前］',$body_content);
                    $body_content = str_replace('[郵便番号］','<br> [郵便番号］',$body_content);
                    $body_content = str_replace('[住　　所］','<br> [住　　所］',$body_content);
                    $body_content = str_replace(' [電話番号］','<br>  [電話番号］',$body_content);
                }else{
                    $body_content = "<div style='display:block;'>".str_replace('{{subject}}',$mail_body_subject,$mail_data[2])."</div>";
                }
                $email_footer = str_replace('{{shop_phone}}',$tel,$mail_data[3]);
                $email_footer = str_replace('{{shop_title}}',$shop_title,$email_footer);
            }else{ 
                $email_subject = "";
                $email_header = "";
                $body_content = "";
                $email_footer = "";
            }
            
            $email_content = str_replace('{{username}}',$header_sender_name,$email_header);
            if ($mail_type != "gmail") {
                $email_content .= '<br><br>';
            }
            $email_content .= str_replace('{{contents}}',$message,$body_content);
            $email_content .= str_replace('{{site_url}}',$site_url,$email_footer);
            Mail::send(new ContactMail($sender_name,$phone,$toMail,$fromMail,$email_subject,$email_content));
            if (count(Mail::failures()) > 0) {
                return "ng";
            }else{
                if(!isset($request['page_name'])){
                    Session::flash("success_mail","メール送信しました。");
                }
                //return view('Admin.test_mail',compact('kokyaku1'));
                $url = 'mail/testMail/'.$request['format_id'];
                return redirect($url)->withInput();
            }
            
        }
    }
}