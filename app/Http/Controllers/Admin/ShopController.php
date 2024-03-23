<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Kokyaku1;
use App\Rules\validChar;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
	public function index()
	{
		$kokyaku = Kokyaku1::find(env('store'));
		if ($kokyaku==NULL) return 'no kokyaku found';
        $kokyaku1_name = Kokyaku1::find(1)->name;
		return view('Admin.Settings.shop',compact('kokyaku' , 'kokyaku1_name'));
	}

	public function edit()
    {
        $kokyaku = Kokyaku1::find(env('store'));
        return $kokyaku;
    }

    public function update($shop_id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required',new validChar,'max:50'],
            'zip1' => 'required|digits:3',
            'zip2' => 'required|digits:4',
            'prefecture' => 'required',
            'address' => ['required',new validChar,'max:100'],
            'tel' => 'required|regex:/^[0-9]*$/|max:11',
            'fax' => 'required|regex:/^[0-9]*$/|max:11',
        ],[
            'required' => '【:attribute】必須項目に入力がありません。',
            'max' => '【:attribute】:max桁以下で入力してください。',
            'tel.regex' => '【:attribute】半角数字以外は使用できません。',
            'fax.regex' => '【:attribute】半角数字以外は使用できません。',
        ],[
        	'name' => 'ショップ名',
			'zip1' => '郵便番号1',
			'zip2' => '郵便番号2',
			'prefecture' => '都道府県',
			'address' => '住所',
			'tel' => '電話番号',
			'fax' => 'FAX番号',
        ]);

        $errors = $validator->errors();

        if($errors->any()) return $errors;

        if(request('will_insert')=='0') return 'ok';

        $update_array =
                [
                    'name' => request('name'),
                    'yubinbango' => request('zip1').'-'.request('zip2'),
                    'address' => request('prefecture').' '.request('address'),
                    'tel' => request('tel'),
                    'fax' => request('fax'),
                    'soukobango' => '1',
                    'hantei' => '4'
                ];

        Kokyaku1::where('bango','=',$shop_id)
                ->update($update_array);

        session()->flash('status', '更新しました。');

        return 'ok';
    }
}