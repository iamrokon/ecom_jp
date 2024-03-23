<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\AllClass\SpecialCharValidation;
use App\AllClass\checkValidEmail;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Session;
use App\Model\Category;
use App\Model\Product;
use App\Model\Product2;
use App\Model\Product3;
use App\Model\Gazou;
use App\Model\Kaiin;
use DB;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $request = $request->all();
        $last_loaded_route = Session::get("last_loaded_route");
        
        $rules=[];
        $rules['email'] = ['required'];
        $rules['password'] = ['required'];
        
        $message=[];    
        $message['email.required']='メールフィールドは必須です。';
        $message['password.required']='パスワードフィールドは必須です。';
        
        $validator = Validator::make($request,$rules,$message); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }else{
            $email = request('email');
            $password = md5(request('password'));
            $loginInfo = DB::select("select * from kaiin where mail = '$email' and passwd = '$password'");
            if(count($loginInfo) > 0){
                $bango = $loginInfo[0]->bango;
                $login_session = [
                        'login_bango' => $bango,
                        'login_name' => $loginInfo[0]->name,
                        'login_email' => $loginInfo[0]->address,
                    ];
                session()->put('userlogin', $login_session);
                $result['redirect'] = $last_loaded_route;
                $result['status'] = "ok";
                return $result;
            }else{
                $result['status'] = "ng";
                return $result;
            }
        }
    }
    
    public function logoutUser()
    {
        session()->forget('shippingInformation');
        session()->forget('userlogin');

        if (strpos(url()->previous(),'orderkakunin') !== false) {
          return redirect()->route('homepage');
        }

        try {
           return back(); 
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }
        
    }
    
    public function registerUser(Request $request)
    {
        $request = $request->all();
        
        $rules=[];
        $rules['username'] = ['bail','required','max:30',new SpecialCharValidation];
        $rules['email'] = ['bail','required','email','regex:/^[a-zA-Z0-9_@.-]+$/','unique:kaiin,mail'];
        $rules['password'] = ['bail','required','min:6','max:20','regex:/^[a-zA-Z0-9@.]+$/'];
        $rules['confirm_password'] = ['nullable','bail','required_with:password','same:password','regex:/^[a-zA-Z0-9@.]+$/'];
        
        $message=[];    
        $message['username.required']='名前を入力してください。';
        $message['email.required']='メールアドレスを入力してください。';
        $message['password.required']='パスワードを入力してください。';
        $message['username.max']='氏名は30文字を超えてはなりません。';
        $message['password.max']='パスワードは20文字を超えてはなりません。';
        $message['confirm_password.max']='パスワードを認証するのは20文字を超えてはなりません。';
        $message['password.min']='6桁以上入力してください。';
        $message['confirm_password.min']='もう一度パスワードを入力してください。';
        $message['confirm_password.required_with']='もう一度パスワードを入力してください。';
        $message['regex']='半角英数字以外は使用できません。';
        $message['unique']='このメールアドレスは既に使用されています。';
        $message['email']='有効なメールアドレスを入力してください。';
        $message['same']='パスワードが一致しません。';
        
        $attributes = [
            'username' => '氏名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'confirm_password' => 'パスワードを認証する',
        ];
        
        $validator = Validator::make($request,$rules,$message,$attributes); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }else{
            DB::beginTransaction();
            try {
                $kaiin = new Kaiin;
                $kaiin->name = request('username');
                $kaiin->mail = request('email');
                $kaiin->passwd = md5(request('password'));
                $kaiin->kounyusu = 0;
                $kaiin->kingakugoukei = 0;
                $kaiin->starttime = Carbon::now()->setTimezone("Asia/Tokyo")->format('Ymd');
                $kaiin->syukei2 = 0;
                $kaiin->save();
                Session::flash('success_msg', "登録に成功しました！");
                DB::commit();

                $login_session = [
                        'login_bango' => $kaiin->bango,
                        'login_name' => $kaiin->name,
                        'login_email' => $kaiin->mail,
                    ];
                session()->put('userlogin', $login_session);

                return "ok";
            } catch (\Exception $ex) {
                DB::rollback();
                $errors->add('',$ex->getMessage());
                return back()->withErrors($errors);
            }
        }
        
    }

    public static function gotosucess()
    {
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();

        return view('UserPanel.completedAuthentication',compact('categories'));
    } 
    
}