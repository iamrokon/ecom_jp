<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use App\Model\Category;
use App\Model\Kaiin;
use App\Model\Haisou;
use App\Model\Kokyaku3;
use DB;
use Mail;
use Storage;
use App\Mail\SendPasswordMail;
use App\Mail\PasswordResetMail;
use App\AllClass\checkValidEmail;
use App\AllClass\Furigana;
use App\AllClass\CheckSameValue;
use App\AllClass\SpecialCharValidation;


class UserController extends Controller
{
    public function index()
    {
        $kaiin_id = Session::get('userlogin')['login_bango'] ;
        $userInfo = Kaiin::where('bango',$kaiin_id)->first();
        $haisouInfo = DB::table('haisou')
                ->selectRaw("
                    bango,
                    name,
                    haisoumoji1 as furigana,
                    concat(substring(yubinbango,1,3),'-',substring(yubinbango,4,4)) as zipcode,
                    SPLIT_PART(address,' ',1) as prefecture,
                    right(address,(LENGTH(address) - LENGTH(SPLIT_PART(address,' ',1))-1)) as address,
                    tel
                "
                )
                ->where('haisousuchi1',$kaiin_id)
                ->orderBy('bango','DESC')
                ->first();
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        $query = DB::table('orderhenkan')
            ->selectRaw("orderhenkan.kokyakuorderbango,
                tuhanorder.orderbango as order_no,
                tuhanorder.chumondate as order_date,
                tuhanorder.numeric1 as total_item,
                --tuhanorder.money10 as amount,
                CASE
                    WHEN toiawasebango.toiawasebango IS NULL THEN '出荷待ち'
                    ELSE '出荷済' END as status,
                toiawasebango.toiawasebango as slip_number"
                )
            ->join('tuhanorder', 'tuhanorder.orderbango', '=', 'orderhenkan.bango')
            ->join('toiawasebango', 'toiawasebango.orderbango', '=', 'orderhenkan.bango')
            ->orderBy('orderhenkan.bango', 'DESC')
            ->whereNotNull('kessaihouhou')
            ->where('orderhenkan.kokyakuorderbango',$kaiin_id);
        $order_query = clone $query;
        $orderList = $order_query->paginate(5);
        //$orderList->setPath('https://demo342.colgis.jp/user'); //to support https
        $count_query = clone $query;
        $total_order = $count_query->count();
        return view('UserPanel.user',compact('categories','brands','userInfo','orderList','total_order','haisouInfo'));
    }
    
    public function updateUser(Request $request)
    {
        $request = $request->all();
        $kaiin_id = Session::get('userlogin')['login_bango'] ;
        $email = Kaiin::where('bango',$kaiin_id)->pluck('mail')[0];
  
        $rules=[];
        $rules['name'] = ['required',new SpecialCharValidation];
        $rules['furigana'] = ['nullable','max:50','regex:/^([゠ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶヷヸヹヺ・ーヽヾヿ]+)$/u'];
        $rules['email'] = ['required',new checkValidEmail,'unique:kaiin,mail,'.$kaiin_id.',bango'];
        $rules['new_password'] = ['nullable','min:5','max:20',new SpecialCharValidation];
        $rules['confirm_password'] = ['nullable','required_with:new_password','same:new_password','min:5','max:20'];
        $rules['zipcode1'] = ['required','regex:/^[0-9]+$/','min:3','max:3'];
        $rules['zipcode2'] = ['required','regex:/^[0-9]+$/','min:4','max:4'];
        $rules['prefecture'] = ['required'];
        $rules['ciadd'] = ['required','max:20',new SpecialCharValidation];
        $rules['address1'] = ['required','max:50',new SpecialCharValidation];
        $rules['address2'] = ['nullable','max:50',new SpecialCharValidation];
        $rules['company_name'] = ['max:50',new SpecialCharValidation];
        $rules['phone'] = ['required','max:11','regex:/^[0-9]+$/'];
        if ($request['year']!=null OR $request['month']!=null OR $request['day']!=null) 
        {
            $rules['year'] = ['required'];
            $rules['month'] = ['required'];
            $rules['day'] = ['required'];
        }
        $message=[];    
        $message['required']='【:attribute】必須項目に入力がありません。';
        $message['unique']='【:attribute】このメールアドレスは既に使用されています。';
        $message['max']='【:attribute】:max桁以下で入力してください。';
        $message['min']='【:attribute】の入力は:min文字以上必要です。';
        $message['regex']='【:attribute】半角数字以外は使用できません。';
        $message['furigana.regex']='【:attribute】カタカナ以外は使用できません。';
        $message['confirm_password.required_with']='もう一度パスワードを入力してください。';
        $message['same']='パスワードが一致しません。';

        $attributes = [
            'name' => '氏名',
            'furigana' => 'フリガナ',
            'email' => 'メールアドレス',
            'new_password' => '新しいパスワード',
            'confirm_password' => '新しいパスワード',
            'zipcode1' => '郵便番号1',
            'zipcode2' => '郵便番号2',
            'prefecture' => '都道府県',
            'ciadd' => '市区町村',
            'address1' => '町名番地',
            'address2' => '建物名・部屋番号',
            'company_name' => '会社名',
            'phone' => '電話番号',
            'year' => '年',
            'month' => '月',
            'day' => '日',
        ];
        
        $validator = Validator::make($request,$rules,$message,$attributes); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }else{
            DB::beginTransaction();
            try {
                $password = DB::select("select * from kaiin where bango = $kaiin_id")[0]->passwd;
                $new_password = request('new_password');
                if($new_password != ""){
                    $password = md5($new_password);
                }
                if(request('address2') != ""){
                    $address = request('prefecture')." ".request('ciadd')." ".request('address1')." ".request('address2');
                }else{
                    $address = request('prefecture')." ".request('ciadd')." ".request('address1');
                }
                if (request('year')!=null) {
                    $date=request('year')."-".request('month')."-".request('day');
                }else{
                    $date=null;
                }
                $kaiin_update_data = [
                    'name' => request('name'),
                    'kaka' => request('furigana'),
                    'mail' => request('email'),
                    'passwd' => $password,
                    'yubinbango' => request('zipcode1').request('zipcode2'),
                    'address' => $address,
                    'kenadd' => request('prefecture'),
                    'ciadd' => request('ciadd'),
                    'cyouadd' => request('address1'),
                    'biladd' => request('address2'),
                    'model' => request('company_name'),
                    'tel' => request('phone'),
                    'sex' => request('sex'),
                    'birthday' => $date,
                ];
                Kaiin::where('bango',$kaiin_id)->update($kaiin_update_data);
                DB::commit();
                if($email != request('email') || $new_password != ""){
                    session()->forget('userlogin');
                    return "login_page";
                }
                Session::flash('success_msg', "登録に成功しました！");
                return "ok";
            } catch (\Exception $ex) {
         
                DB::rollback();
                return "ng";
            }
        } 
    }
    
    public function updateHaisouData(Request $request)
    {
        $request = $request->all();
        $kaiin_id = Session::get('userlogin')['login_bango'] ;
        
        $rules=[];
        $rules['name'] = ['required',new SpecialCharValidation];
        $rules['furigana'] = ['nullable','max:50','regex:/^([゠ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶヷヸヹヺ・ーヽヾヿ]+)$/u'];
        $rules['zipcode_1'] = ['required','regex:/^[0-9]+$/','min:3','max:3'];
        $rules['zipcode_2'] = ['required','regex:/^[0-9]+$/','min:4','max:4'];
        $rules['prefecture'] = ['required'];
        $rules['address'] = ['required',new SpecialCharValidation];
        $rules['phone'] = ['required','max:11','regex:/^[0-9]+$/'];
        
        $message=[];    
        $message['required']='【:attribute】必須項目に入力がありません。';
        $message['max']='【:attribute】:max桁以下で入力してください。';
        $message['min']='【:attribute】の入力は:min文字以上必要です。';
        $message['regex']='【:attribute】半角数字以外は使用できません。';
        $message['furigana.regex']='【:attribute】カタカナ以外は使用できません。';

        $attributes = [
            'name' => '氏名',
            'furigana' => 'フリガナ',
            'zipcode_1' => '郵便番号1',
            'zipcode_2' => '郵便番号2',
            'prefecture' => '都道府県',
            'address' => '住所',
            'phone' => '電話番号',
        ];
        
        $validator = Validator::make($request,$rules,$message,$attributes); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }else{
            DB::beginTransaction();
            try {
                $haisou_bango = request('haisou_bango');
                $address = $request['prefecture']." ".$request['address'];
                $haisou_update_data = [
                    'name' => request('name'),
                    'haisoumoji1' => request('furigana'),
                    'yubinbango' => request('zipcode_1').request('zipcode_2'),
                    'address' => $address,
                    'tel' => request('phone'),
                ];
                Haisou::where('bango',$haisou_bango)->update($haisou_update_data);
                DB::commit();
                Session::flash('success_msg', "登録に成功しました！");
                return "ok";
            } catch (\Exception $ex) {
                DB::rollback();
                return "ng";
            }
        } 
    }
    
    public function updateUserPassword(Request $request)
    {
        $request = $request->all();
        $kaiin_id = Session::get('userlogin')['login_bango'] ;
        $password = Kaiin::where('bango',$kaiin_id)->pluck('passwd')[0];
        $rules=[];
        $rules['password'] = ['required',new CheckSameValue(md5($request['password']),$password)];
        $rules['npassword'] = ['required'];
        $rules['cpassword'] = ['required_with:npassword','same:npassword'];
        
        $message=[];    
        $message['password.required']='パスワード を入力する必要があります。';
        $message['password.max']='パスワードは20文字を超えてはなりません。';
        $message['npassword.max']='パスワードを認証するのは20文字を超えてはなりません。';
        $message['password.min']='パスワード が短すぎます (最低でも5文字以上です)。';
        $message['npassword.min']='パスワード が短すぎます (最低でも5文字以上です)。';
        $message['cpassword.required_with']='パスワードが存在する場合、「パスワードの確認」フィールドは必須です。';
        $message['same']='パスワードと確認パスワードは一致している必要があります。';
        
        $validator = Validator::make($request,$rules,$message); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }else{
            DB::beginTransaction();
            try {
                $kaiin_update_data = [
                    'passwd' => md5(request('npassword')),
                ];
                Kaiin::where('bango',$kaiin_id)->update($kaiin_update_data);
                DB::commit();
                session()->forget('userlogin');
                
                //send password via mail
                $fromMail = "s_maeda@colgis.co.jp";
                $toMail = request('temp_email');
                $email_subject = "Password";
                $password = request('npassword');
                Mail::send(new SendPasswordMail($toMail,$fromMail,$email_subject,$password));
                if (count(Mail::failures()) > 0) {
                    return "ng";
                }
                
                return "ok";
            } catch (\Exception $ex) {
                DB::rollback();
                return "ng";
            }
        } 
    }
    
    
    public function orderDetails($order_no)
    {
        $kaiin_id = Session::get('userlogin')['login_bango'] ;    
        $percentage = Kokyaku3::where('bango',1)->first()->syouhizeiritu;
        $orderItemList = DB::table('orderhenkan')
            ->selectRaw("orderhenkan.bango as order_no,
                tuhanorder.chumondate as order_date,
                tuhanorder.numeric1 as total_item,
                tuhanorder.kessaihouhou,
                tuhanorder.juchukubun2,
                tuhanorder.otodoketime,
                CASE 
                  WHEN tuhanorder.juchukubun2= '佐川急便' AND tuhanorder.otodoketime ='01' THEN  '午前中'
                  WHEN tuhanorder.juchukubun2= '佐川急便' AND tuhanorder.otodoketime ='12' THEN  '14:00-16:00'
                  WHEN tuhanorder.juchukubun2= '佐川急便' AND tuhanorder.otodoketime ='14' THEN  '16:00-18:00'
                  WHEN tuhanorder.juchukubun2= '佐川急便' AND tuhanorder.otodoketime ='16' THEN  '18:00-20:00'
                  WHEN tuhanorder.juchukubun2= '佐川急便' AND tuhanorder.otodoketime ='18' THEN  '19:00-21:00'
                  WHEN tuhanorder.juchukubun2= '佐川急便' AND tuhanorder.otodoketime IS NULL THEN  NULL
                   WHEN tuhanorder.juchukubun2= 'ヤマト運輸' AND tuhanorder.otodoketime ='0812' THEN  '午前中'
                   WHEN tuhanorder.juchukubun2= 'ヤマト運輸' AND tuhanorder.otodoketime ='1416' THEN  '14:00-16:00'  
                   WHEN tuhanorder.juchukubun2= 'ヤマト運輸' AND tuhanorder.otodoketime ='1618' THEN  '16:00-18:00'
                   WHEN tuhanorder.juchukubun2= 'ヤマト運輸' AND tuhanorder.otodoketime ='1820' THEN  '18:00-20:00'
                   WHEN tuhanorder.juchukubun2= 'ヤマト運輸' AND tuhanorder.otodoketime ='1921' THEN  '19:00-21:00'

                   ELSE  NULL
                END as  delivery_time, 
                substring(tuhanorder.otodokedate::text,1,10)  as delivery_date,
                tuhanorder.information5 as delivery_name,
                tuhanorder.money2 as delivery_charge,
                tuhanorder.money1 as settlement_charge,
                --tuhanorder.money10 as sub_total,
                tuhanorder.moneymax as total_payment,
                syouhin1.jouhou as product_name,
                misyukko.syukkasu as qty,
                misyukko.tanka as price,
                toiawasebango.toiawasebango,
                case 
                   when toiawasebango.toiawasebango IS NULL then '出荷待ち'
                   else '出荷済' 
                end as status,
                tuhanorder.kessaihouhou as payment_method"
                )
            ->join('misyukko', 'orderhenkan.bango', '=', 'misyukko.orderbango')
            ->join('tuhanorder', 'tuhanorder.orderbango', '=', 'orderhenkan.bango')
            ->join('syouhin1', 'syouhin1.bango', '=', DB::raw('misyukko.syouhinbango::int'))
            ->join('toiawasebango', 'toiawasebango.orderbango', '=', 'orderhenkan.bango')
            ->orderBy('orderhenkan.bango', 'DESC')
            ->whereRaw("orderhenkan.kokyakuorderbango = '$kaiin_id'")
            ->whereRaw("misyukko.orderbango = '$order_no'")
            ->whereRaw("misyukko.syouhinname <> '送料'")
            ->whereRaw("misyukko.syouhinname <> '決済手数料'")
            ->get();

        if(count($orderItemList) > 0){
            $view = view('UserPanel.orderDetails',compact('orderItemList','percentage'))->render();
            return response()->json(['status' => "ok", 'view' => $view]);
        }else{
            return view('UserPanel.404');
        }
    }
    
    public function resetPassword(Request $request)
    {
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        if(request()->method() == "POST"){
            $input = $request->all();
            
            $rules=[];
            $rules['email'] = ['required','email','exists:kaiin,mail'];

            $message=[];    
            $message['required']='必須項目に入力がありません。';
            $message['email']='入力された項目に誤りがあります。<br>ご確認のうえ、再度ご入力をお願いいたします。';
            $message['exists']='入力された項目に誤りがあります。<br>ご確認のうえ、再度ご入力をお願いいたします。';

            $attributes = [
                'email' => 'メールアドレス',
            ];

            $validator = Validator::make($input,$rules,$message,$attributes); 
            $errors = $validator->errors();
            if($errors->any()){ 
                $error_msgs = $errors->all();
                return ['err_field' => $errors, 'err_msg' => $error_msgs];
            }
            
            //send mail
            $toMail = $request['email'];
            $fromMail = DB::table('kokyaku1')->where('bango',env('store'))->first()->mail_soushin;
            $shopName = DB::table('kokyaku1')->where('bango',env('store'))->first()->name;
            $shopTel = DB::table('kokyaku1')->where('bango',env('store'))->first()->tel;
            $userName = Kaiin::where('mail',$request['email'])->first()->name;
            
            $url = url('/reset').'/'.encrypt($toMail);

            $file_name = '7.json';
            if (Storage::disk('mail')->exists($file_name)) 
            {
                $contents = Storage::disk('mail')->get($file_name);
                $mail_data = json_decode($contents);
                
                $email_subject = $mail_data[0];
                $html = $mail_data[1] . $mail_data[2] . $mail_data[3];

                $html = str_replace('{{reset_password_url}}', $url, $html);
                $html = str_replace('{{shop_title}}', $shopName, $html);
                $html = str_replace('{{shop_phone}}', $shopTel, $html);
                $html = str_replace('{{site_url}}',route('homepage'),$html);
                $html = str_replace('{{username}}',$userName,$html);
            }
            else
            {
                $html = "Url: ".$url."<br>";
                $email_subject = "Reset Password";
            }
                
            Mail::send(new PasswordResetMail($toMail,$fromMail,$shopName,$email_subject,$html));
            if (count(Mail::failures()) > 0) {
                return "ng";
            }else{
                return "ok";
            }
            
        }else{
            return view('UserPanel.resetPassword',compact('categories','brands'));  
        }
    }
    
    public function reset(Request $request,$email)
    {
        if($request->ajax()){
            $input = $request->all();
            $email = $input['email'];
            
            $rules=[];
            $rules['password'] = ['required','min:6','max:20','regex:/^[a-zA-Z0-9@.]+$/'];
            $rules['email'] = ['required','exists:kaiin,mail'];
            $rules['con_password'] = ['nullable','required_with:password','same:password','regex:/^[a-zA-Z0-9@.]+$/'];

            $message=[];    
            $message['required']='必須項目に入力がありません。';
            $message['exists']='入力内容が誤っています。';
            $message['password.max']='パスワードは20文字を超えてはなりません。';
            $message['con_password.max']='パスワードを認証するのは20文字を超えてはなりません。';
            $message['password.min']='6桁以上入力してください。';
            $message['con_password.min']='もう一度パスワードを入力してください。';
            $message['con_password.required_with']='もう一度パスワードを入力してください。';
            $message['regex']='半角英数字以外は使用できません。';
            $message['same']='パスワードが一致しません。';

            $attributes = [
                'email' => 'メールアドレス',
                'password' => 'パスワード',
                'con_password' => 'パスワードを認証する',
            ];

            $validator = Validator::make($input,$rules,$message,$attributes); 
            $errors = $validator->errors();
            if($errors->any()){ 
                $error_msgs = $errors->all();
                return ['err_field' => $errors, 'err_msg' => $error_msgs];
            }
            
            DB::beginTransaction();
            try {
                $kaiin_update_data = [
                    'passwd' => md5(request('password')),
                ];
                Kaiin::where('mail',$email)->update($kaiin_update_data);
                DB::commit();
                session()->forget('userlogin');
                return "ok";
            } catch (\Exception $ex) {
                DB::rollback();
                return "ng";
            }
            
        }else{
            $email = decrypt($email);
            return view('UserPanel.reset',compact('email')); 
        }
    }
    
    public function validateMemberCancellation(Request $request){
        $input = $request->all();
        $email = $input['email'];

        $rules=[];
        $rules['email'] = ['required','email','regex:/^[a-zA-Z0-9_@.-]+$/','exists:kaiin,mail'];
        $rules['password'] = ['required','min:6','max:20','regex:/^[a-zA-Z0-9@.]+$/'];

        $message=[];    
        $message['required']='【:attribute】必須項目に入力がありません。';
        $message['password.max']='パスワードは20文字を超えてはなりません。';
        $message['password.min']='6桁以上入力してください。';
        $message['regex']='【:attribute】半角英数字以外は使用できません。';
        $message['email']='有効なメールアドレスを入力してください。';
        $message['exists']='入力内容が誤っています。';

        $attributes = [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];

        $validator = Validator::make($input,$rules,$message,$attributes); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }
        return "ok";
    }
    
    
    public function memberCancellation(Request $request){
        $input = $request->all();
        $email = $input['email'];
        $password = md5($input['password']);
        $loginInfo = DB::select("select bango from kaiin where mail = '$email' and passwd = '$password'");
        if(count($loginInfo) > 0){
            $kaiin_id = $loginInfo[0]->bango;
            $misyukko = DB::select("select count(kaiinid) from misyukko where kaiinid = '$kaiin_id'");
            if($misyukko[0]->count > 0){
                return 'ng';
            }else{
                DB::beginTransaction();
                try {
                    $kaiin_update_data = [
                        'name' => '99999',
                        'mail' => null,
                        'tel' => '99999',
                        'address' => '99999',
                        'passwd' => 'DELLxxxxxxxxxxxxxxxx',
                    ];
                    Kaiin::where('bango',$kaiin_id)->update($kaiin_update_data);
                    session()->forget('userlogin');
                    DB::commit();
                    session()->flash("member_cancellation_msg","会員は正常に解除されました。");
                    return "ok";
                } catch (\Exception $ex) {
                    DB::rollback();
                    return "ng";
                }
            }
        }else{
            return 'no_user';
        }
        
    }
    
    
}