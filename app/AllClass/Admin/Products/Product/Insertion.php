<?php

namespace App\AllClass\Admin\Products\Product;

class Insertion
{
	public static function product($product, $request)
	{
        $product->kokyakubango = $request['kokyaku'];
        $product->data51 = $request['parent_category'];
        $product->data52 = $request['child_category'] ?? NULL;
        $product->mdjouhou = $request['mdjouhou'];
        $product->kongouritsu = $request['sku'];
        $product->koyuujouhou = $request['jan_code'];
        $product->kokyakusyouhinbango = $request['brand_part'];
        $product->jouhou = $request['jouhou'];
        $product->data50 = $request['data50'];
        $product->size = $request['size'];
        $product->color = $request['color'];
        $product->kakaku = $request['retail_price'];
        $product->data23 = $request['selling_price'];
        $product->datatxt0107 = $request['material_notation'];
        $product->datatxt0108 = $request['measuring_info'];
        $product->synchrosyouhinbango = $request['max_purchase'];
        $product->isdaihyou = $request['display_flag'];
        $product->endtime = $request['store_flag'];
        $product->code1 = $request['recommendation'];
        $product->datatxt0106 = $request['comment'];

        return $product;
    }

    public static function gazou($gazou, $path_array)
    {
        if ($path_array[0] != NULL) $gazou->url = $path_array[0];
        $gazou->setumei = $path_array[1];
        $gazou->catch = $path_array[2];
        $gazou->caption = $path_array[3];
        $gazou->catchsm = $path_array[4];
        $gazou->mbcatch = $path_array[5];

        return $gazou;
    }
}