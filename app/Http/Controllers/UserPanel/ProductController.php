<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Session;
use App\Model\Category;
use App\Model\Product;
use App\Model\Product2;
use App\Model\Product3;
use App\Model\Gazou;
use App\Model\Zaiko;
use DB;

class ProductController extends Controller
{
    public function productDetails($product_id,$product_name)
    {
        //set loaded route
        Session::put("last_loaded_route",url()->current());
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        $product_id= request('product_id');
        $product_name= request('product_name');
        $productDetails = DB::select("
            select
            syouhin1.bango as product_id,
            syouhin1.jouhou as product_name,
            syouhin1.kokyakusyouhinbango,
            syouhin1.data23,
            syouhin1.kakaku,
            syouhin1.color as product_color,
            syouhin1.size as product_size,
            syouhin1.data50 as gender,
            syouhin1.datatxt0106 as product_comment,
            syouhin1.datatxt0107 as product_material,
            syouhin1.datatxt0108 as measuring_info,
            syouhin2.jouhou2 as product_description,
            categorykanri.bango as category_id,
            categorykanri.zokusei as category_name,
            gazou.url as file_name,
            gazou.setumei as file_name2,
            gazou.catch as file_name3,
            gazou.caption as file_name4,
            gazou.catchsm as file_name5,
            gazou.mbcatch as file_name6,
            --CASE
            --     WHEN 
            --      (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = $product_id) > 0
            --     THEN  'stock_in'
            --ELSE 'stock_out' END stock_status_zaiko, 
            
            CASE
                WHEN (
                    CASE
                        WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = $product_id) > COALESCE(syouhin1.synchrosyouhinbango,0)
                            THEN  COALESCE(syouhin1.synchrosyouhinbango,0)
                        ELSE (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = $product_id) END
                    ) > 0 THEN 'stock_in'
                ELSE 'stock_out' END stock_status,
                   
            --(select zokusei as brand_name from categorykanri where categorykanri.bango = syouhin1.mdjouhou::int and groupbango = '2')
            syouhin1.mdjouhou as brand_name
            from syouhin1
            join syouhin2 on syouhin2.bango = syouhin1.bango
            join syouhin3 on syouhin3.bango = syouhin1.bango
            join gazou on gazou.syouhinbango = syouhin1.bango
            left join categorykanri on categorykanri.bango::text = syouhin1.data51
            where syouhin1.bango = $product_id  and syouhin1.endtime = 1 AND syouhin1.isphoto = 0
            --and syouhin1.isdaihyou = 1
            ");
   
        if(count($productDetails)>0){
            $category_id = $productDetails[0]->category_id;
            $recommendedProducts = DB::select("
                select
                syouhin1.bango as product_id,
                syouhin1.jouhou as product_name,
                syouhin1.data23,
                syouhin1.kakaku,
                categorykanri.zokusei as category_name,
                COALESCE(categorykanri.category2,'1') as parent_category_status,
                childCategory.zokusei as child_category_name,
                COALESCE(childCategory.category2,'1') as child_category_status,
                --CASE
                --    WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > 0 THEN 'stock_in'
                --    ELSE 'stock_out' END stock_status,
            
                CASE
                    WHEN (
                        CASE
                            WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > COALESCE(syouhin1.synchrosyouhinbango,0)
                                THEN  COALESCE(syouhin1.synchrosyouhinbango,0)
                            ELSE (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) END
                        ) > 0 THEN 'stock_in'
                    ELSE 'stock_out' END stock_status,
                
                --CASE
                --    WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > 0 THEN 'stock_in'
                --    ELSE 'stock_out' END stock_status,
                (select COALESCE(synchrosyouhinbango,0) from syouhin1 where syouhin1.bango = $product_id) < 0,
                --(select zokusei as brand_name from categorykanri where categorykanri.bango = syouhin1.mdjouhou::int and groupbango = '2'),
                syouhin1.mdjouhou as brand_name,
                gazou.url as file_name
                from syouhin1
                join syouhin2 on syouhin2.bango = syouhin1.bango
                join syouhin3 on syouhin3.bango = syouhin1.bango
                join gazou on gazou.syouhinbango = syouhin1.bango
                left join categorykanri on categorykanri.bango::text = syouhin1.data51
                left join categorykanri as childCategory on childCategory.bango::text = syouhin1.data52
                where syouhin1.bango != $product_id and categorykanri.bango = $category_id 
                and syouhin1.isdaihyou = 1 and syouhin1.endtime = 1
                and syouhin1.isphoto = 0
                order by syouhin1.bango desc
                limit 5
                ");
            $recommendedProducts = collect($recommendedProducts)->where('parent_category_status',1)->where('child_category_status',1);
            return view('UserPanel.productDetails',compact('categories','brands','productDetails','recommendedProducts')); 
        }else{
            return view('UserPanel.404');
        }
    }
    
    public function productList()
    {
        $input = request()->all();
               
        //set loaded route
        Session::put("last_loaded_route","productList");
        
        if(request('pagi')){
            $pagination = request('pagi');
        }else{
            $pagination = 50;
        }
        
        if(isset($input['cat']) && count($input['cat']) > 0){
            $cat = request('cat');
            $temp_cat = request('cat');
        }else{
            $cat = array();
            $temp_cat = array();
        }
        
        if(isset($input['sub_cat']) &&  count($input['sub_cat']) > 0){
            $sub_cat = request('sub_cat');
        }else{
            $sub_cat = array();
        }
        
        //unset parent category if sub cat is selected
        foreach($sub_cat as $key=>$val){
            if($val != ""){
                $parent_cat_id = Category::select('category1')->where('zokusei',$val)->where('osusume','1')->first()->category1 ?? "";
                $parent_cat_name = Category::select('zokusei')->where('bango',$parent_cat_id)->where('osusume','1')->first()->zokusei ?? "";
                if(array_search($parent_cat_name, $temp_cat) == false){
                    $unset_key = array_search($parent_cat_name, $temp_cat);
                    unset($temp_cat[$unset_key]);
                }
            }else{
                unset($sub_cat[$key]);
            }
        }
        
        if(request('brand')){
            $brand = request('brand');
        }else{
            $brand = "";
        }
        
        if(request('type')){
            $type = request('type');
        }else{
            $type = "";
        }
        
        if(request('price')){
            $price = request('price');
            $start_price = explode("〜",$price)[0];
            $end_price = explode("〜",$price)[1];
        }else{
            $price = "";
        }
        
        if(request('off')){
            $off = request('off');
            $start_off = explode("〜",$off)[0];
            if(isset(explode("〜",$off)[1])){
                $end_off = explode("〜",$off)[1];
            }else{
                $end_off = "";
            }
        }else{
            $off = "";
        }
        
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        
        $query = DB::table('syouhin1')
            ->selectRaw("
                syouhin1.bango as product_id,
                syouhin1.jouhou as product_name,
                syouhin1.data23,
                syouhin1.kakaku,
                syouhin1.data50,
                syouhin1.data52,
                syouhin1.tokuchou,
                --(select zokusei from categorykanri where categorykanri.bango = syouhin1.name::int and name not in('送料','代引き手数料','決済手数料') ) as category_name,
                (select zokusei from categorykanri where categorykanri.bango::text = syouhin1.data51) as category_name,
                (select category2 from categorykanri where categorykanri.bango::text = syouhin1.data51) as parent_category_status,
                (select category2 from categorykanri where categorykanri.bango::text = syouhin1.data52) as child_category_status,

                CASE
                    WHEN (
                        CASE
                            WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > COALESCE(syouhin1.synchrosyouhinbango,0)
                                THEN  COALESCE(syouhin1.synchrosyouhinbango,0)
                            ELSE (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) END
                        ) > 0 THEN 'stock_in'
                    ELSE 'stock_out' END stock_status,
                
                --CASE
                --    WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > 0 THEN 'stock_in'
                --    ELSE 'stock_out' END stock_status,
                    
                --categorykanri.zokusei as brand_name,
                syouhin1.mdjouhou as brand_name,
                gazou.url as file_name
                ")
            ->join('syouhin2', 'syouhin2.bango', '=', 'syouhin1.bango')
            ->join('syouhin3', 'syouhin3.bango', '=', 'syouhin1.bango')
            ->join('gazou', 'gazou.syouhinbango', '=', 'syouhin1.bango')
            ->leftJoin('categorykanri', DB::raw('categorykanri.bango::text'), '=', 'syouhin1.mdjouhou')
            ->where('syouhin1.isdaihyou',1)
            ->where('syouhin1.endtime',1)
            ->where('syouhin1.isphoto',0);
        
        $query = DB::table($query, 'product_list');
        
        if(count($temp_cat) > 0){
            $query->whereIn('product_list.category_name',$temp_cat);
        }
        
        if(isset($input['sub_cat']) && count($input['sub_cat']) > 0){
            $sub_category_id = Category::select('bango')->whereIn('zokusei',$sub_cat)->where('osusume','1')->get();
            $query->orWhereIn('product_list.data52',$sub_category_id);
        }
        
        //if($brand != ""){
        //    $query->where('product_list.brand_name',$brand);
        //}
        
        //if($type != ""){
        //    $query->where('product_list.data50',$type);
        //}
        
        //if($price != ""){
        //    if($end_price == ""){
        //        $query->whereRaw("
        //            (CASE
        //                WHEN product_list.data23 IS NULL THEN product_list.kakaku
        //                ELSE CAST(product_list.data23 AS DOUBLE PRECISION) END
        //            ) >= '$start_price'
        //            ");
        //    }else{
        //        $query->whereRaw("
        //           (CASE
        //               WHEN product_list.data23 IS NULL THEN product_list.kakaku
        //               ELSE CAST(product_list.data23 AS DOUBLE PRECISION) END
        //           ) >= '$start_price'
        //           AND
        //           (CASE
        //               WHEN product_list.data23 IS NULL THEN product_list.kakaku
        //               ELSE CAST(product_list.data23 AS DOUBLE PRECISION) END
        //           ) <= '$end_price'    
        //           ");   
        //    }
        //}
        
        //if($off != ""){
        //    if($end_off == ""){
        //        $query->whereRaw("
        //            (CASE
        //                WHEN product_list.data23 IS NOT NULL THEN ROUND(100 - (CAST(product_list.data23 AS DOUBLE PRECISION) / (product_list.kakaku)*100))
        //                ELSE 0 END
        //            ) >= '$start_off'
        //            ");
        //    }else{
        //        $query->whereRaw("
        //           (CASE
        //               WHEN product_list.data23 IS NOT NULL THEN ROUND(100 - (CAST(product_list.data23 AS DOUBLE PRECISION) / (product_list.kakaku)*100))
        //               ELSE CAST(product_list.data23 AS DOUBLE PRECISION) END
        //           ) >= '$start_off'
        //           AND
        //           (CASE
        //               WHEN product_list.data23 IS NOT NULL THEN ROUND(100 - (CAST(product_list.data23 AS DOUBLE PRECISION) / (product_list.kakaku)*100))
        //               ELSE 0 END
        //           ) <= '$end_off'    
        //           ");   
        //    }
        //}
        
        $query->orderBy('product_id', 'DESC');
        
        $product_query = clone $query;
        $products = $product_query->where('parent_category_status','1')->whereRaw("(CASE WHEN child_category_status is null THEN '1' ELSE child_category_status END) = '1'")->paginate($pagination);
      
        $product_count_query = clone $query;
        $total_product = $product_count_query->where('parent_category_status','1')->whereRaw("(CASE WHEN child_category_status is null THEN '1' ELSE child_category_status END) = '1'")->count();

        return view('UserPanel.productList',compact('categories','brands','products','pagination','cat','sub_cat','brand','type','price','off','total_product'));
    }
    
    public function searchProduct()
    {
        if(request('pagi')){
            $pagination = request('pagi');
        }else{
            $pagination = 12;
        }
        
        if(request('cat') != "all"){
            $search_category = request('cat');
        }else{
            $search_category = "";
        }
        
        if(request('data')){
            $data = request('data');
        }else{
            $data = "";
        }
       
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        $query = DB::table('syouhin1')
        ->selectRaw("syouhin1.bango as product_id,
            syouhin1.jouhou as product_name,
            syouhin1.data23,
            syouhin1.kakaku,
            --categorykanri.zokusei as brand_name,
            syouhin1.mdjouhou as brand_name,
            categorykanri.zokusei as category_name,
            categorykanri.category2 as parent_category_status,
            (select category2 from categorykanri where categorykanri.bango::text = syouhin1.data52) as child_category_status,
            --CASE
            --    WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > 0 THEN 'stock_in'
            --    ELSE 'stock_out' END stock_status,
            
            CASE
                WHEN (
                    CASE
                        WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > COALESCE(syouhin1.synchrosyouhinbango,0)
                            THEN  COALESCE(syouhin1.synchrosyouhinbango,0)
                        ELSE (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) END
                    ) > 0 THEN 'stock_in'
                ELSE 'stock_out' END stock_status,   

            gazou.url as file_name")
        ->join('syouhin2', 'syouhin2.bango', '=', 'syouhin1.bango')
        ->join('syouhin3', 'syouhin3.bango', '=', 'syouhin1.bango')
        ->join('gazou', 'gazou.syouhinbango', '=', 'syouhin1.bango')
        ->leftJoin('categorykanri', DB::raw('categorykanri.bango::text'), '=', 'syouhin1.data51')
        ->where('syouhin1.isdaihyou',1)
        ->where('syouhin1.endtime',1)
        ->where('syouhin1.isphoto',0);
        if($search_category != ""){
            $query->where('categorykanri.zokusei',$search_category);
        }
        if($data != ""){
            $query->where('syouhin1.jouhou', 'ilike', '%' . $data . '%');
        }
        $query->orderBy('product_id', 'DESC');
        $query = DB::table($query, 'search_product_list');
        $main_query = clone $query;
        $products = $main_query->where('parent_category_status','1')->whereRaw("(CASE WHEN child_category_status is null THEN '1' ELSE child_category_status END) = '1'")->paginate($pagination);
        if ($products->items() == null && $products->currentPage() != 1) {
            $currentPage = ($products->lastPage());
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
            $products = $main_query->paginate($pagination);
        }
        $count_query = clone $query;
        $total_product = $count_query->where('parent_category_status','1')->whereRaw("(CASE WHEN child_category_status is null THEN '1' ELSE child_category_status END) = '1'")->count();
        return view('UserPanel.search',compact('categories','brands','products','pagination','total_product','search_category','data'));
    }
    
    public function quickViewProductDetails()
    { 
        $categories = Category::where('groupbango','1')->whereNull('category1')->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get();
        $brands = Category::where('groupbango','2')->where('osusume','1')->get();
        $product_id= request('product_id');
        $productDetails = DB::select("
            select
            syouhin1.bango as product_id,
            syouhin1.jouhou as product_name,
            syouhin1.kokyakusyouhinbango,
            syouhin1.data23,
            syouhin1.kakaku,
            syouhin1.color as product_color,
            syouhin1.size as product_size,
            syouhin1.data50 as gender,
            syouhin1.datatxt0106 as product_comment,
            syouhin1.datatxt0107 as product_material,
            syouhin2.jouhou2 as product_description,
            categorykanri.bango as category_id,
            categorykanri.zokusei as category_name,
            gazou.url as file_name,
            gazou.setumei as file_name2,
            gazou.catch as file_name3,
            gazou.caption as file_name4,
            gazou.catchsm as file_name5,
            gazou.mbcatch as file_name6,
            
            CASE
                WHEN (
                    CASE
                        WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > COALESCE(syouhin1.synchrosyouhinbango,0)
                            THEN  COALESCE(syouhin1.synchrosyouhinbango,0) 
                        ELSE (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) END
                    ) > 0 THEN 'stock_in'
                ELSE 'stock_out' END stock_status,
            
            --CASE
            --    WHEN (select COALESCE(sum(zaikosu),0) from zaiko where zaiko.syouhinbango = syouhin1.bango) > 0 THEN 'stock_in'
            --    ELSE 'stock_out' END stock_status,
                
            --(select zokusei as brand_name from categorykanri where categorykanri.bango = syouhin1.mdjouhou::int and groupbango = '2')
            syouhin1.mdjouhou as brand_name
            from syouhin1
            join syouhin2 on syouhin2.bango = syouhin1.bango
            join syouhin3 on syouhin3.bango = syouhin1.bango
            join gazou on gazou.syouhinbango = syouhin1.bango
            left join categorykanri on categorykanri.bango::text = syouhin1.data51
            where syouhin1.bango = $product_id and syouhin1.endtime = 1
            --and syouhin1.isdaihyou = 1
            and syouhin1.isphoto = 0
            ");
        $view = view('UserPanel.productDetailsModal',compact('categories','brands','productDetails'))->render(); 
        return response()->json(['status' => "ok", 'view' => $view]);
    }
    
    public function checkStock($req_qty,$product_id){
        $sum_of_zaikosu = Zaiko::where('syouhinbango',$product_id)->sum('zaikosu');
        $sum_of_synchrosyouhinbango = Product::where('bango',$product_id)->sum('synchrosyouhinbango');

        if($sum_of_zaikosu > $sum_of_synchrosyouhinbango){
            $qty = $sum_of_synchrosyouhinbango;
           
        }else{
            $qty = $sum_of_zaikosu;
        }
      
        if($req_qty > $qty){
           $return_qty = $qty;
        }else{
           $return_qty = $req_qty;
        }
        $result['status'] = "ok";
        $result['qty'] = $return_qty;
        return $result;
    }
    
}