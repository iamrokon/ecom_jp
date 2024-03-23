<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

class ShoppingCart{
    //add item to the cart
    public static function addToCart($item_array){
        $product_id = $item_array['id'];
        $qty = $item_array['qty'];

        if(Cookie::get('shopping_cart_cookie')){
            $cookie_data = stripslashes(Cookie::get('shopping_cart_cookie'));
            $cart_data = json_decode($cookie_data, true);
        }else{
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'id');
        $prod_id_is_there = $product_id;

        if(in_array($prod_id_is_there, $item_id_list))
        {
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["id"] == $product_id)
                {
                    $cart_data[$keys]["qty"] = $qty;
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart_cookie', $item_data, $minutes));
                    return response()->json(['status'=>'"'.$cart_data[$keys]["id"].'" Already Added to Cart','status2'=>'2']);
                }
            }
        }
        else
        {
            $cart_data[] = $item_array;
            $item_data = json_encode($cart_data);
            $minutes = 60;
            Cookie::queue(Cookie::make('shopping_cart_cookie', $item_data, $minutes));
            //return response()->json(['status'=>$product_id.' Added to Cart']);
        }
    }
    
    //fetch all cart item
    public static function get(){
        if(Cookie::get('shopping_cart_cookie')){
            $cookie_data = stripslashes(Cookie::get('shopping_cart_cookie'));
            $cart_data = json_decode($cookie_data, true);
        }else{
            $cart_data = array();
        }
        return $cart_data;
    }
    
    //remove a cart item
    public static function remove($prod_id){
        $cookie_data = stripslashes(Cookie::get('shopping_cart_cookie'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'id');
        $prod_id_is_there = $prod_id;

        if(in_array($prod_id_is_there, $item_id_list))
        {
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["id"] == $prod_id)
                {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart_cookie', $item_data, $minutes));
                    //return response()->json(['status'=>'Item Removed from Cart']);
                }
            }
        }
    }
    
    //clear all cart items
    public static function destroy(){
        Cookie::queue(Cookie::forget('shopping_cart_cookie'));
        //return response()->json(['status'=>'Your Cart is Cleared']);
    }
    
}
    
    