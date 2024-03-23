<?php

namespace App\AllClass\Admin\Products\Product;

use App\Rules\validChar;
use App\Rules\Zenkaku;
use App\Model\Product;

class Validation
{
	public static function rules($method, $product_id=NULL)
	{
		$rules = [
			'kokyaku' => 'required|regex:/^[0-9]*$/|max:50',
			'jouhou' => [ 'required' , 'max:255', new validChar],
			'brand_part' => [ 'required', 'max:100', new validChar ],
			'parent_category' => 'nullable|regex:/^[0-9]*$/|max:50',
			'child_category' => 'nullable|regex:/^[0-9]*$/|max:50',
			'mdjouhou' => [ 'nullable' , 'max:10', new validChar],
			'sku' => [ 'required' , 'max:50', new validChar],
			'jan_code' => 'nullable|regex:/^[0-9]*$/|max:50',
			'data50' => [ 'nullable' , 'max:10', new validChar],
			'size' => [ 'nullable' , 'max:100', new validChar ],
			'color' => [ 'nullable' , 'max:100', new validChar ],
			'retail_price' => 'nullable|regex:/^[0-9]*$/|max:8',
			'selling_price' => 'required|regex:/^[0-9]*$/|max:8',
			'arrival_cost' => 'nullable|regex:/^[0-9]*$/|max:8',
			'tax_rate' => 'nullable|regex:/^[0-9]*$/|max:2',
			'material_notation' => [ 'nullable' , 'max:2000', new validChar ],
			'measuring_info' => [ 'nullable' , 'max:600', new validChar ],
			'max_purchase' => 'required|regex:/^[0-9]*$/|max:3',
			'display_flag' => 'required',
			'store_flag' => 'required',
			'recommendation' => 'required',
			'comment' => [ 'nullable' , 'max:2000', new validChar ],
			'main_image' => [ 'mimes:jpg,jpeg','max:1999' ]
		];
		if($method==='create')
		{
			$rules['main_image'][] = 'required';
		}
		else 
		{
			$product = Product::where('bango', '=', $product_id)
            ->with(['gazou'])
            ->first();
      if( $product->gazou!=NULL && $product->gazou->url!=NULL) $rules['main_image'][] = 'nullable';
			else $rules['main_image'][] = 'required';
		}
		return $rules;
	}

	public static function messages()
	{
		return [
            'required' => '【:attribute】必須項目に入力がありません。',
            'max' => '【:attribute】:max桁以下で入力してください。',
            'jan_code.regex' => '【:attribute】半角数字以外は使用できません。',
            'retail_price.regex' => '【:attribute】半角数字以外は使用できません。',
            'selling_price.regex' => '【:attribute】半角数字以外は使用できません。',
            'arrival_cost.regex' => '【:attribute】半角数字以外は使用できません。',
            'tax_rate.regex' => '【:attribute】半角数字以外は使用できません。',
            'max_purchase.regex' => '【:attribute】半角数字以外は使用できません。',
            'mimes' => '【:attribute】ファイル形式：jpg・jpegのみ対応です。',
        ];
	}

	public static function attributes()
	{
		return [
			'jouhou' => '商品名',
			'mdjouhou' => 'キャプション',
			'sku' => 'SKU',
			'jan_code' => 'JAN/EAN コード',
			'data50' => 'キャプション2',
			'brand_part' => '品番',
			'size' => 'サイズ',
			'color' => 'カラー',
			'retail_price' => '小売希望価格（税込）',
			'selling_price' => 'サイト販売価格（税込）',
			'arrival_cost' => '入荷原価（税抜）',
			'tax_rate' => '消費税率 (%)',
			'material_notation' => '素材表記',
			'measuring_info' => '採寸情報',
			'max_purchase' => '商品購入上限数',
			'display_flag' => '商品一覧表示フラグ',
			'store_flag' => '出店フラグ',
			'recommendation' => 'おすすめ',
			'comment' => '商品コメント',
			'main_image' => 'メイン画像',
		];
	}
}
