<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\AllClass\Admin\Products\Product\Query;
use App\AllClass\Admin\Products\Product\Validation;
use App\AllClass\Admin\Products\Product\Insertion;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Kokyaku1;
use App\Model\Product;
use App\Model\Product2;
use App\Model\Product3;
use App\Model\Gazou;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use File;
use Storage;
use App\Services\Product\ImageResponseCreate;
use App\Services\Product\ProductResponseCreate;
use App\ShopifyApi\ProductApiClient;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public static $IMAGE_WIDTH = 500;
    public static $IMAGE_HEIGHT = 500;

    public function index()
    {
        $per_page = 15;

        Query::base(request('search') , request('sort_column') , request('sort_dir'));

        $count = Query::count();

        $current_page = request('page');
        $last_page = ceil($count / $per_page);

        Paginator::currentPageResolver(
            function () use ($last_page, $current_page) {
                if ($last_page === 0) return 1;
                if ($current_page > $last_page) return $last_page;
                return $current_page;
            }
        );

        $products = Query::get()->paginate($per_page);

        $sortable_headers = [
            '仕入先' => 'kokyaku_name',
            '商品名' => 'jouhou',
            '品番' => 'kokyakusyouhinbango',
            'カテゴリ（親）' => 'parent_category_zokusei',
            'カテゴリ（子）' => 'child_category_zokusei',
            'キャプション' => 'mdjouhou',
            'SKU' => 'kongouritsu',
            'JAN/EAN コード' => 'koyuujouhou',
            'キャプション2' => 'data50',
            'サイズ' => 'size',
            'カラー' => 'color',
            '小売希望価格（税込）' => 'int_kakaku',
            'サイト販売価格（税込）' => 'data23',
            '入荷原価（税抜）' => 'int_genka',
            '消費税率 (%)' => 'int_syouhizeiritu',
            '素材表記' => 'datatxt0107',
            '採寸情報' => 'datatxt0108',
            '商品購入上限数' => 'int_synchrosyouhinbango',
            '商品一覧表示フラグ' => 'isdaihyou',
            '出店フラグ' => 'endtime',
            'おすすめ' => 'code1',
            '商品コメント' => 'datatxt0106',
        ];

        return view('Admin.Product.index', compact('products', 'sortable_headers'));
    }

    public function create()
    {
        $parent_categories = Category::where('osusume', '=', 1)
            ->where('groupbango', '=', 1)
            ->whereNull('category1')
            ->orderBy('bango','ASC')
            ->get();
        $kokyakus = Kokyaku1::where('hantei', '=', 1)
            ->orderByRaw("case when bango = 4 then 0 else 1 end,bango")
            ->get();
        $categories = array();

        foreach ($parent_categories as $parent_category) {
            $categories[$parent_category->bango]
                = Category::where('osusume', '=', 1)
                ->where('groupbango', '=', 1)
                ->where('category1', '=', $parent_category->bango)
                ->orderBy('bango','ASC')
                ->get();
        }

        return view('Admin.Product.create', compact('parent_categories', 'kokyakus', 'categories'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), Validation::rules('create'), Validation::messages(),Validation::attributes());

        $errors = $validator->errors();
        if(!$errors->has('selling_price') && request('selling_price') <= 0) $errors->add('selling_price','No giving away free.');

        if(!$errors->has('brand_part') &&
            !$errors->has('size') &&
            !$errors->has('color')) 
        {
            $same_product = Product::where('kokyakusyouhinbango', '=', request('brand_part'))
                                    ->where('size', '=', request('size'))
                                    ->where('color', '=', request('color'))
                                    ->first();

            if($same_product != NULL)
            {
                $errors->add('brand_part','同一商品が存在します。　No. ' . $same_product->bango);
                $errors->add('size','');
                $errors->add('color','');
            }
        }

        if(!$errors->has('sku')) 
        {
            $same_product = Product::where('kongouritsu', '=', request('sku'))
                                    ->first();

            if($same_product != NULL)
            {
                $errors->add('sku','同一商品が存在します。　No. ' . $same_product->bango);
            }
        }
            

        if ($errors->any()) return $errors;

        $path_array = [NULL, NULL, NULL, NULL, NULL, NULL];

        $file_name_to_store = md5(random_bytes(10)) . date('YmdHis') . '.' . $request->file('main_image')->getClientOriginalExtension();

        $file_path = Storage::disk('product')->getAdapter()->getPathPrefix();
        if (!file_exists($file_path)) 
        {
            mkdir($file_path, 0777, true);
        }

        Storage::disk('product')->putFileAs('', $request->file('main_image'), $file_name_to_store);
        $mime = Storage::disk('product')->mimeType($file_name_to_store);
        
        if($mime=='image/jpeg')
        {
            $image = imagecreatefromjpeg($file_path.$file_name_to_store);
            $imgResized = imagescale($image , self::$IMAGE_WIDTH, self::$IMAGE_HEIGHT);
            imagejpeg($imgResized,$file_path.'resized_'.$file_name_to_store);
        }
        else if($mime=='image/png')
        {
            $image = imagecreatefrompng($file_path.$file_name_to_store);
            $imgResized = imagescale($image , self::$IMAGE_WIDTH, self::$IMAGE_HEIGHT);
            imagepng($imgResized,$file_path.'resized_'.$file_name_to_store);
        }
        $path_array[0] = 'resized_'.$file_name_to_store;
        unlink($file_path.$file_name_to_store);

        foreach (explode("||", request('photo_list')) as $key => $value) 
        {
            if ($value != NULL) $path_array[$key] = $value;
        }

        DB::beginTransaction();
        try {
            $product = new Product;
            $product->isphoto = 0;
            $product->iskakaku = 1;
            $product = Insertion::product($product, request()->all());

            $product->save();

            $bango = $product->bango;

            $gazou = new Gazou;
            $gazou->syouhinbango = $bango;
            $gazou = Insertion::gazou($gazou, $path_array);
            $gazou->save();

            $product2 = new Product2;
            $product2->bango = $bango;
            $product2->iskouseihin = 0;
            $product2->genka = request('arrival_cost');
            $product2->save();

            $product3 = new Product3;
            $product3->bango = $bango;
            $product3->keisangenka = request('arrival_cost');
            $product3->syouhizeiritu = request('tax_rate');
            $product3->save();

            // $this->insertProductToShopify($product->bango);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            $errors->add('', $ex->getMessage());
            return $errors;
        }

        session()->flash('status', '登録しました');

        return 'ok';
    }

    public function edit($product_id)
    {
        $product = Product::where('bango', '=', $product_id)
            ->with(['product2', 'product3', 'gazou'])
            ->first();

        $parent_categories = Category::where('osusume', '=', 1)
            ->where('groupbango', '=', 1)
            ->whereNull('category1')
            ->orderBy('bango','ASC')
            ->get();

        $kokyakus = Kokyaku1::where('hantei', '=', 1)
            ->orderByRaw("case when bango = 4 then 0 else 1 end,bango")
            ->get();
        $categories = array();

        foreach ($parent_categories as $parent_category) {
            $categories[$parent_category->bango]
                = Category::where('osusume', '=', 1)
                ->where('groupbango', '=', 1)
                ->where('category1', '=', $parent_category->bango)
                ->orderBy('bango','ASC')
                ->get();
        }
        if($product->gazou!=NULL)
        $photo_array = [$product->gazou->setumei, $product->gazou->catch, $product->gazou->caption, $product->gazou->catchsm, $product->gazou->mbcatch];
        else $photo_array = [];

        $photo_list = '||';

        foreach ($photo_array as $photo) {
            if ($photo != NULL) $photo_list .= $photo . '||';
        }

        return view('Admin.Product.edit', compact('product', 'parent_categories', 'kokyakus', 'categories', 'photo_list'));
    }


    public function update($product_id, Request $request)
    {
        $validator = Validator::make(request()->all(), Validation::rules('edit',$product_id), Validation::messages(), Validation::attributes());

        $errors = $validator->errors();

        if(!$errors->has('selling_price') && request('selling_price') <= 0) $errors->add('selling_price','No giving away free.');

        if(!$errors->has('brand_part') &&
            !$errors->has('size') &&
            !$errors->has('color'))
        {
            $same_product = Product::where('kokyakusyouhinbango', '=', request('brand_part'))
                                    ->where('size', '=', request('size'))
                                    ->where('color', '=', request('color'))
                                    ->where('bango', '<>', $product_id)
                                    ->first();

            if($same_product != NULL)
            {
                $errors->add('brand_part','同一商品が存在します。　No. ' . $same_product->bango);
                $errors->add('size','');
                $errors->add('color','');
            }
        }

        if(!$errors->has('sku')) 
        {
            $same_product = Product::where('kongouritsu', '=', request('sku'))
                                    ->where('bango', '<>', $product_id)
                                    ->first();

            if($same_product != NULL)
            {
                $errors->add('sku','同一商品が存在します。　No. ' . $same_product->bango);
            }
        }
            

        if ($errors->any()) return $errors;

        $path_array = [NULL, NULL, NULL, NULL, NULL, NULL];

        if (request('main_image') != NULL) 
        {
            $file_name_to_store = md5(random_bytes(10)) . date('YmdHis') . '.' . $request->file('main_image')->getClientOriginalExtension();

            $file_path = Storage::disk('product')->getAdapter()->getPathPrefix();
            if (!file_exists($file_path)) 
            {
                mkdir($file_path, 0777, true);
            }
            
            Storage::disk('product')->putFileAs('', $request->file('main_image'), $file_name_to_store);
            $mime = Storage::disk('product')->mimeType($file_name_to_store);
            
            if($mime=='image/jpeg')
            {
                $image = imagecreatefromjpeg($file_path.$file_name_to_store);
                $imgResized = imagescale($image , self::$IMAGE_WIDTH, self::$IMAGE_HEIGHT);
                imagejpeg($imgResized,$file_path.'resized_'.$file_name_to_store);
            }
            else if($mime=='image/png')
            {
                $image = imagecreatefrompng($file_path.$file_name_to_store);
                $imgResized = imagescale($image , self::$IMAGE_WIDTH, self::$IMAGE_HEIGHT);
                imagepng($imgResized,$file_path.'resized_'.$file_name_to_store);
            }
            $path_array[0] = 'resized_'.$file_name_to_store;
            unlink($file_path.$file_name_to_store);
        }

        foreach (explode("||", request('photo_list')) as $key => $value) {
            if ($value != NULL) $path_array[$key] = $value;
        }

        DB::beginTransaction();
        try {
            $product = Product::where('bango', '=', $product_id)->first();
            $product = Insertion::product($product, request()->all());

            $product->save();

            $gazou = Gazou::where('syouhinbango', '=', $product_id)->first();
            if($gazou==NULL)
            {
                $gazou = new Gazou;
                $gazou->syouhinbango = $product_id;
            }
            $gazou = Insertion::gazou($gazou, $path_array);
            $gazou->save();

            $product2 = Product2::where('bango', '=', $product_id)->first();
            if($product2==NULL)
            {
                $product2 = new Product2;
                $product2->bango = $product_id;
            }
            $product2->genka = request('arrival_cost');
            $product2->save();

            $product3 = Product3::where('bango', '=', $product_id)->first();
            if($product3==NULL)
            {
                $product3 = new Product3;
                $product3->bango = $product_id;
            }
            $product3->keisangenka = request('arrival_cost');
            $product3->syouhizeiritu = request('tax_rate');
            $product3->save();

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            $errors->add('', $ex->getMessage());
            return $errors;
        }

        session()->flash('status', '商品' . request('jouhou') . '更新しました');

        return 'ok';
    }

    public function insertProductToShopify($productId)
    {
        try {
            $shopifyProductDetails = DB::table('syouhin1')
                ->join('categorykanri as cat1', 'syouhin1.name', '=', DB::raw("CAST(cat1.bango as varchar)"))
                ->join('categorykanri as cat2', 'syouhin1.mdjouhou', '=', DB::raw("CAST(cat2.bango as varchar)"))
                ->join('gazou', 'syouhin1.bango', '=', 'gazou.syouhinbango')
                ->where('syouhin1.bango', $productId)
                ->select(
                    'syouhin1.bango',
                    'syouhin1.jouhou as title',
                    'syouhin1.kokyakusyouhinbango as description',
                    'syouhin1.kakaku as retail_price',
                    'syouhin1.data23 as selling_price',
                    'syouhin1.data51 as weight',
                    'cat1.zokusei as category',
                    'cat2.zokusei as brand',
                    'gazou.url as main_image',
                    'gazou.setumei as first_image',
                    'gazou.catch as second_image',
                    'gazou.caption as third_image',
                    'gazou.catchsm as fourth_image',
                    'gazou.mbcatch as fifth_image',
                )->first();

            $images = collect($shopifyProductDetails)->only('main_image', 'first_image', 'second_image', 'third_image', 'fourth_image', 'fifth_image')->values()->filter(function ($value) {
                return !is_null($value);
            });
            $productResponse = (new ProductResponseCreate($shopifyProductDetails))->make();
            $resource = (new ProductApiClient())->create($productResponse);
            $productId = $resource->product->id;
            if ($images) {
                foreach ($images as $key =>  $image) {
                    (new ProductApiClient())->insertImage($productId, (new ImageResponseCreate($image, $key + 1))->make());
                }
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function image(Request $request)
    {
        app('debugbar')->disable();
        $validator = Validator::make(request()->all(), [
            'photos.*' => ['mimes:jpg,jpeg','max:1999']
        ],[
            'photos.*.mimes' => '【追加画像】ファイル形式：jpg・jpegのみ対応です。',
        ]);

        $errors = $validator->errors();

        if (is_array(request('photos')) && (request('uploadedImageNumber') + count(request('photos'))) > 5) $errors->add('photos', '【追加画像】5つまで選択可能です。');

        if ($errors->any()) {
            $return_string = "NG||";
            foreach ($errors->all() as $error) 
            {
                $return_string .= $error . "||";
            }
            return $return_string;
        }

        $path_array = array();

        if (request('photos')) 
        {
            foreach (request('photos') as $key => $value) 
            {
                $file_name_to_store = md5(random_bytes(10)) . date('YmdHis') . '.' . $request->file('photos.' . $key)->getClientOriginalExtension();
                $file_path = Storage::disk('product')->getAdapter()->getPathPrefix();
                if (!file_exists($file_path)) 
                {
                    mkdir($file_path, 0777, true);
                }
                Storage::disk('product')->putFileAs('', $request->file('photos.' . $key), $file_name_to_store);
                $mime = Storage::disk('product')->mimeType($file_name_to_store);
                
                if($mime=='image/jpeg')
                {
                    $image = imagecreatefromjpeg($file_path.$file_name_to_store);
                    $imgResized = imagescale($image , self::$IMAGE_WIDTH, self::$IMAGE_HEIGHT);
                    imagejpeg($imgResized,$file_path.'resized_'.$file_name_to_store);
                }
                else if($mime=='image/png')
                {
                    $image = imagecreatefrompng($file_path.$file_name_to_store);
                    $imgResized = imagescale($image , self::$IMAGE_WIDTH, self::$IMAGE_HEIGHT);
                    imagepng($imgResized,$file_path.'resized_'.$file_name_to_store);
                }
                
                $path_array[$key + 1] = 'resized_'.$file_name_to_store;
                unlink($file_path.$file_name_to_store);
            }
        }
        return json_encode($path_array);
    }
}
