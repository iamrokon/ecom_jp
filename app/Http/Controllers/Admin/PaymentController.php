<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Kokyaku1;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
	public function index()
	{
		$kokyaku = Kokyaku1::find(env('store'));
		if ($kokyaku==NULL) return 'no kokyaku found';
        $domain = $kokyaku->domain;
        if($domain==NULL) $charges = [ NULL, NULL, NULL, NULL, NULL, NULL ];
        else
        {
            $temp = explode('=', $domain);
            $temp2 = array();
            foreach($temp as $tem)
            {
                $temp2[] = explode('/', $tem)[0];
            }
            if(sizeof($temp2)==2) // only flat charge
            {
                $charges = [ NULL, NULL, NULL, NULL, $temp2[1], $temp2[0] ];
            }
            else $charges = [ $temp2[1], $temp2[2], $temp2[3], $temp2[4], NULL, $temp2[0] ];
        }
        $domain2 = $kokyaku->domain2;
        if($domain2==NULL) $kuroneko_charges = [ NULL, NULL ];
        else
        {
            $temp = explode('=', $domain2);
            $temp2 = explode('/', $temp[1]);
            $kuroneko_charges = [ $temp2[0], $temp2[1] ];
        }
        return view('Admin.Settings.payment',compact('kokyaku','charges','kuroneko_charges'));
	}

    public function update($payment_id)
    {
        $rules = [
            'cod' => ['required'],
            'flat_charge' => ['nullable','regex:/^[0-9]*$/','max:8'],
            'free_value' => ['nullable','regex:/^[0-9]*$/','max:8'],
            'credit' => ['required'],
            'kuroneko_payment' => ['required'],
            'kuroneko_free_value' => ['nullable','regex:/^[0-9]*$/','max:8'],
        ];

        $rules['cod_limit'][] = (request('cod')==='1') ? 'required' : 'nullable';
        $rules['kuroneko_fee'][] = (request('kuroneko_payment')==='1') ? 'required' : 'nullable';
        $rules['kuroneko_limit'][] = (request('kuroneko_payment')==='1') ? 'required' : 'nullable';

        $rules['cod_limit'][] = 'regex:/^[0-9]*$/';
        $rules['kuroneko_fee'][] = 'regex:/^[0-9]*$/';
        $rules['kuroneko_limit'][] = 'regex:/^[0-9]*$/';

        $rules['cod_limit'][] = 'max:8';
        $rules['kuroneko_fee'][] = 'max:8';
        $rules['kuroneko_limit'][] = 'max:8';

        if(request('cod')==='1' && 
            (request('charge_~10k')!==NULL || request('charge_10k~30k')!==NULL || request('charge_30k~100k')!==NULL || request('charge_100k~')!==NULL))
        {
            $rules['charge_~10k'][] = 'required';
            $rules['charge_10k~30k'][] = 'required';
            $rules['charge_30k~100k'][] = 'required';
            $rules['charge_100k~'][] = 'required';
        }
        else
        {
            $rules['charge_~10k'][] = 'nullable';
            $rules['charge_10k~30k'][] = 'nullable';
            $rules['charge_30k~100k'][] = 'nullable';
            $rules['charge_100k~'][] = 'nullable';
        }

        $rules['charge_~10k'][] = 'regex:/^[0-9]*$/';
        $rules['charge_~10k'][] = 'max:8';
        $rules['charge_10k~30k'][] = 'regex:/^[0-9]*$/';
        $rules['charge_10k~30k'][] = 'max:8';
        $rules['charge_30k~100k'][] = 'regex:/^[0-9]*$/';
        $rules['charge_30k~100k'][] = 'max:8';
        $rules['charge_100k~'][] = 'regex:/^[0-9]*$/';
        $rules['charge_100k~'][] = 'max:8';


        $validator = Validator::make(
            request()->all(),
            $rules,
        [
            'required' => '【:attribute】必須項目に入力がありません。',
            'max' => '【:attribute】:max桁以下で入力してください。',
            'regex' => '【:attribute】半角数字以外は使用できません。',
        ],[
        	'cod' => '代金引換',
            'charge_~10k' => '10,000円未満',
            'charge_10k~30k' => '10,000円以上30,000円未満',
            'charge_30k~100k' => '30,000円以上100,000円未満',
            'charge_100k~' => '100,000円以上',
            'flat_charge' => '手数料一律',
            'cod_limit' => '代引利用限度額',
            'free_value' => '手数料無料基準値',
            'credit' => 'クレジットカード',
            'kuroneko_payment' => 'クロネコ後払い',
            'kuroneko_fee' => '手数料',
            'kuroneko_limit' => '利用限度額',
            'kuroneko_free_value' => '手数料無料基準値',
        ]);

        $errors = $validator->errors();

        if(request('cod')==='1' && request('flat_charge')!==NULL &&
            (request('charge_~10k')!==NULL || request('charge_10k~30k')!==NULL || request('charge_30k~100k')!==NULL || request('charge_100k~')!==NULL)
        )
        {
            $errors->add('flat_charge','【手数料一律】【代引手数料】は同時利用ができません。');
        }

        if(request('cod')==='1' && request('flat_charge')===NULL && request('charge_~10k')===NULL && request('charge_10k~30k')===NULL && request('charge_30k~100k')===NULL && request('charge_100k~')===NULL)
        {
            $errors->add('charge_~10k','');
            $errors->add('charge_10k~30k','');
            $errors->add('charge_30k~100k','');
            $errors->add('charge_100k~','');
            $errors->add('charge_~10k','');
            $errors->add('flat_charge','【手数料一律】【代引手数料】どちらか入力してください。');
        }

        if($errors->any()) return $errors;

        $update_array =
                [
                    'point3' => request('cod'),
                    'daibikigenkai' => (request('cod')==1) ? request('free_value') : NULL,
                    'black1' => request('credit'),
                    'black2' => request('kuroneko_payment'),
                    'kakakutaibango1' => (request('kuroneko_payment')==1) ? request('kuroneko_free_value') : NULL,
                ];

        if(request('cod')==='1')
        {
            if(request('flat_charge')!==NULL) $update_array['domain'] = request('cod_limit').'='.request('flat_charge').'/'.request('cod_limit');

            else $update_array['domain'] = request('cod_limit').'='.request('charge_~10k').'/'.'10000'.'='.request('charge_10k~30k').'/'.'30000'.'='.request('charge_30k~100k').'/'.'100000'.'='.request('charge_100k~').'/'.request('cod_limit');
        }
        else $update_array['domain'] = NULL;

        if(request('kuroneko_payment')==='1')
        {
            $update_array['domain2'] = request('kuroneko_limit').'='.request('kuroneko_fee').'/'.request('kuroneko_limit');
        }
        else $update_array['domain2'] = NULL;

        Kokyaku1::where('bango','=',$payment_id)
                ->update($update_array);

        session()->flash('status', '更新しました');

        return 'ok';
    }
}