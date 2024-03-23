<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tantousya;
use App\Model\Kokyaku1;
use Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('Admin.login');
    }
    public function authenticate()
    {

        $tantousya = Tantousya::find(request('username'));
        if($tantousya!=NULL)
        {
            if(!$tantousya->is_locked())
            {
                if(request('password') == $tantousya->passwd)
                {
                    $token = '';
                          do
                          {
                              $bytes = uniqid();
                              $token .= str_replace(
                                  ['.','/','='],
                                  '',
                                  base64_encode($bytes)
                              );
                          } while (strlen($token) < 5);

                    $tantousya->accesscode = $token;
                    $tantousya->save();
                    session(['admin' => $tantousya->bango]);
                    $kokyaku = Kokyaku1::find(env('store'));
                    if($kokyaku!=NULL) $kokyaku_name = $kokyaku->name;
                    else $kokyaku_name = '';
                    session(['kokyaku_name' => $kokyaku_name]);
                    $tantousya = Tantousya::find(request('username'));
                    session(['tantousya' => $tantousya]);
                    return redirect()->route('admin.customer.index',compact('tantousya'));
                }
                else
                {
                    if($tantousya->accesscode=='1') $tantousya->accesscode = '2';
                    else if($tantousya->accesscode=='2') $tantousya->accesscode = '3';
                    else $tantousya->accesscode = '1';
                    $tantousya->save();
                    $errors[] = 'ユーザーIDまたはパスワードが間違っています。';
                }
            }
            else $errors[] = 'account is locked' ;
        }
        else
        {
            $errors[] = 'ユーザーIDまたはパスワードが間違っています。';
        }
        return redirect()->back()->withInput(request()->all())->withErrors($errors);
    }
    public function logout()
    {
        if(session()->has('admin')) {
            $bango = session()->pull('admin');
            $tantousya = Tantousya::find($bango);
            $tantousya->accesscode = NULL;
            $tantousya->save();

        }    
        return redirect()->route('admin.login');
    }
}
