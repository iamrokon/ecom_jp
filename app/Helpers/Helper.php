<?php
use App\Model\Product;
use App\Model\Category;

function getProductColorList($kokyakusyouhinbango,$product_size) {
   $color = Product::distinct('color')->select('color','bango','jouhou')->where('kokyakusyouhinbango',$kokyakusyouhinbango)->whereNotNull('color')->where('size',$product_size)->whereIn('isdaihyou',array(0,1))->where('endtime',1)->where('isphoto',0)->get(); 
   return $color;
}

function getProductSizeList($kokyakusyouhinbango,$product_color) {
   $size = Product::distinct('size')->select('size','bango','jouhou')->where('kokyakusyouhinbango',$kokyakusyouhinbango)->whereNotNull('size')->where('color',$product_color)->whereIn('isdaihyou',array(0,1))->where('endtime',1)->where('isphoto',0)->get(); 
   return $size;
}

function getSubCategoryList($parent_category) {
   $sub_categories = Category::where('groupbango','1')->where('category1',$parent_category)->where('osusume','1')->where('category2','1')->orderBy('suchi1')->orderBy('zokusei')->get(); 
   return $sub_categories;
}