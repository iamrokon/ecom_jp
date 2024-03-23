<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Session;
use App\Model\Category;
use App\Model\Product;
use App\Model\Product2;
use App\Model\Product3;
use App\Model\Gazou;
use App\Model\Kaiin;
use App\Model\Zaiko;
use App\Helpers\ShoppingCart;
use DB;
use Cart;

class ShoppingController extends Controller
{
    public function addToShopCart($product_id)
    {
        //if(!Session::has('userlogin')){
        //    return "gotoLogin";
        //}
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $product_id= request('product_id');
        $product_name= request('product_name');
        $productDetails = DB::select("
            select
            syouhin1.bango as product_id,
            syouhin1.jouhou as product_name,
            syouhin1.data23 as product_price,
            syouhin1.kakaku as product_old_price,
            syouhin1.color as product_color,
            syouhin1.size as product_size,
            syouhin2.jouhou2 as product_description,
            categorykanri.zokusei as category_name,
            gazou.url as file_name
            from syouhin1
            join syouhin2 on syouhin2.bango = syouhin1.bango
            join syouhin3 on syouhin3.bango = syouhin1.bango
            join gazou on gazou.syouhinbango = syouhin1.bango
            left join categorykanri on categorykanri.bango::text = syouhin2.konpoumei
            where syouhin1.bango = $product_id
            ");
        
        if(count($productDetails)>0){
            
            $qty = request('qty');
            $cartData = Cart::content()->where('id',$product_id);
            if(count($cartData) > 0)
            {
                foreach($cartData as $row)
                {
                    $qty += $row->qty;
                }
            }
            
            //check stock qty
            $sum_of_zaikosu = Zaiko::where('syouhinbango',$product_id)->sum('zaikosu');
            $sum_of_synchrosyouhinbango = Product::where('bango',$product_id)->sum('synchrosyouhinbango');
            if($sum_of_zaikosu > $sum_of_synchrosyouhinbango){
                $stock_qty = $sum_of_synchrosyouhinbango;
            }else{
                $stock_qty = $sum_of_zaikosu;
            }
            if($qty > $stock_qty){
                $status = "out_of_stock";
               return $status;
            }
            //check stock qty end
            
            $product_name = $productDetails[0]->product_name;
            $product_price = $productDetails[0]->product_price;
            $product_description = $productDetails[0]->product_description;
            $file_name = $productDetails[0]->file_name;
            $category_name = $productDetails[0]->category_name;
            $color = $productDetails[0]->product_color;
            $size = $productDetails[0]->product_size;
            Cart::setGlobalTax(0);
            //if(request('page_name') == 'product_details'){
            
            if(count($cartData) > 0){
                foreach($cartData as $row){
                    Cart::remove($row->rowId);
                }
            }
            
            //$color = request('color');
            //$size = request('size');
            
            Cart::add(['id' => $product_id, 'name' => $product_name, 'qty' => $qty, 'price' => $product_price,'weight' => 100,'options' => ['product_description' => $product_description,'file_name' => $file_name,'color'=>$color,'size'=>$size]]);
            
            return "ok";
        }else{
            return view('UserPanel.404');
        }
    }
    
    public function quickAddToShopCart($product_id)
    {
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $product_id= request('product_id');
        $productDetails = DB::select("
            select
            syouhin1.bango as product_id,
            syouhin1.jouhou as product_name,
            syouhin1.data23 as product_price,
            syouhin1.kakaku as product_old_price,
            syouhin1.color as product_color,
            syouhin1.size as product_size,
            syouhin2.jouhou2 as product_description,
            categorykanri.zokusei as category_name,
            gazou.url as file_name
            from syouhin1
            join syouhin2 on syouhin2.bango = syouhin1.bango
            join syouhin3 on syouhin3.bango = syouhin1.bango
            join gazou on gazou.syouhinbango = syouhin1.bango
            left join categorykanri on categorykanri.bango::text = syouhin2.konpoumei
            where syouhin1.bango = $product_id
            ");
       
        if(count($productDetails)>0)
        {
            $qty = 1;
            $cartData = Cart::content()->where('id',$product_id);
            if(count($cartData) > 0)
            {
                foreach($cartData as $row)
                {
                    $qty += $row->qty;
                }
            }
            
            $orderByZaikosuQuery = "Zaiko.SyouhinBango ASC,replace(coalesce(Zaiko.dataChar02, ''),'|',' ') ASC,coalesce(Zaiko.dataInt01, 0)
            ASC,regexp_replace(Zaiko.TanaBango, '^MIKAKUTEI', '~') ASC,Zaiko.ZaikoSu ASC";
            //$stock =  DB::table('zaiko')
            //        ->where('syouhinbango', $product_id)
            //        ->orderByRaw($orderByZaikosuQuery)->get();
            $sum_of_zaikosu = Zaiko::where('syouhinbango',$product_id)->sum('zaikosu');
            $sum_of_synchrosyouhinbango = Product::where('bango',$product_id)->sum('synchrosyouhinbango');
           
            //if(count($stock) <= 0 OR $sum_of_synchrosyouhinbango < 1){
            
            if($sum_of_zaikosu > $sum_of_synchrosyouhinbango){
                $stock_qty = $sum_of_synchrosyouhinbango;
            }else{
                $stock_qty = $sum_of_zaikosu;
            }
            
            //if($stock <= 0){
            if($qty > $stock_qty){
                $result['status'] = 'out_of_stock';
                return  $result;
            }
            
            $product_name = $productDetails[0]->product_name;
            $product_price = $productDetails[0]->product_price;
            $product_description = $productDetails[0]->product_description;
            $file_name = $productDetails[0]->file_name;
            $category_name = $productDetails[0]->category_name;
            $color = $productDetails[0]->product_color;
            $size = $productDetails[0]->product_size;
            Cart::setGlobalTax(0);
            //remove exist cart item
            if(count($cartData) > 0){
                foreach($cartData as $row){
                    Cart::remove($row->rowId);
                }
            }

            Cart::add(['id' => $product_id, 'name' => $product_name, 'qty' => $qty, 'price' => $product_price,'weight' => 100,'options' => ['product_description' => $product_description,'file_name' => $file_name,'color'=>$color,'size'=>$size]]);
            $mini_cartlist_html = view('UserPanel.inc.mini_cartlist')->render();
            $result['status'] = 'ok';
            $result['mini_cartlist_html'] = $mini_cartlist_html;
            return $result;
                
        }else{
            return view('UserPanel.404');
        }
    }
    
    public function cartItemList()
    {
        //stock check
        $stock = self::checkStock();
        
        //set loaded route
        Session::put("last_loaded_route","cartItemList");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.shopCart',compact('categories','brands')); 
    }
    
    public function removeCartItem($rowId)
    {
        try {
            Cart::remove($rowId);
            return redirect('cartItemList');
        } catch (\Exception $ex) {
            return redirect('cartItemList');
        }
    }
    
    public function clearCart()
    {
        Cart::destroy();
        return redirect('cartItemList');
    }
    
    
    public function updateCartList()
    {
        //set loaded route
        Session::put("last_loaded_route","updateCartList");
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        return view('UserPanel.updateCartList',compact('categories','brands'));   
    }
    
    public function updateCartData()
    {
        $rowids = request('rowId');
        $qtys = request('qty');
        for($i =0 ;$i<count($rowids);$i++){
            $rowId = $rowids[$i];
            $qty = (int) $qtys[$i];
           Cart::update($rowId, $qty); 
        }
        
        //stock check
        $stock = self::checkStock();
        if(count($stock) > 0){
            return  redirect("cartItemList");
        }
        
        return redirect('cartItemList');
    }
    
    public function checkout()
    {
        //stock check
        $stock = self::checkStock();
        if(count($stock) > 0){
            return  redirect("cartItemList");
        }
            
        //set loaded route
        Session::put("last_loaded_route","checkout");
       
        if(Cart::content()->count() > 0){
            if(Session::has('shippingInformation')){
                
               if (strpos(url()->previous(),'payment') !== false) {
                   $shippingInfo = Session::get('shippingInformation');
               }else{
                   $shippingInfo = NULL;
               }
            }else{
                $shippingInfo = null;
            }

            $kens=\Config('ken');
            $ken_name=[];
            foreach ($kens as $key => $value) {
                foreach($value as $k=>$val){
                    array_push($ken_name, $val);
                }
            }
           
            $kaiin_id = Session::get('userlogin');
            $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
            $brands = Category::where('groupbango','2')->where('osusume','1')->get();
            $userInfo = Kaiin::where('bango',$kaiin_id)->first();
      
            $haisous=DB::table('haisou')->where('haisousuchi1',$kaiin_id)->whereNotNull('haisousuchi1')->orderBy('bango','DESC')->get();
            return view('UserPanel.checkout',compact('categories','brands','userInfo','shippingInfo','ken_name','haisous')); 
        }else{
            return redirect("cartItemList");
        }
        
    }
    public static function getSenderAddress($id)
    {
       $detail=DB::table('haisou')->where('bango',$id)->first();
  
        return json_encode($detail); 
    }
    public static function checkStock()
    {
        $stock_out_msg = array();
        foreach(Cart::content() as $row){
            $product_id  = $row->id;
            $qty  = $row->qty;
            $productDetails = DB::select("
            select
            syouhin1.bango as product_id,
            syouhin1.jouhou as product_name,
            --(select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) as stock
            CASE
                WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > COALESCE(syouhin1.synchrosyouhinbango,0)
                    THEN  COALESCE(syouhin1.synchrosyouhinbango,0)
                ELSE (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) END as stock
            from syouhin1
            where syouhin1.bango = $product_id and syouhin1.isdaihyou = 1 and syouhin1.endtime = 1
            ");
            if(count($productDetails) > 0 && $qty > $productDetails[0]->stock){
                $stock_out_msg[] = "【".$productDetails[0]->product_name."】の在庫が不足しており、商品を購入することはできませんでした。";
            }
        }
        if(count($stock_out_msg) > 0){
            session()->put('stock_out_msg', $stock_out_msg);
        }else{
            session()->forget('stock_out_msg');
        }
        return $stock_out_msg;
    }
    
}