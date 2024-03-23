<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\AllClass\Admin\Products\Brands\Query;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Rules\validChar;
use Illuminate\Support\Facades\Validator;
use File;
use Storage;
use Illuminate\Pagination\Paginator;

class BrandController extends Controller
{
    public function index()
    {
        $per_page = 15;

        Query::base(request('search') , request('sort_column') , request('sort_dir') , request('collection'));
        
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

        $brands = Query::get()->paginate($per_page);

        $sortable_headers = [
            'ブランド名' => 'zokusei',
            '説明' => 'patternsub1'
        ];

        return view('Admin.brand',compact('brands' , 'sortable_headers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required','max:10',new validChar],
            'description' => 'required|max:200',
            'image'=> 'required|mimes:jpg|max:5120'
        ],[
            'required' => '【:attribute】必須項目に入力がありません。',
            'max' => '【:attribute】:max文字以内で入力してください。',
            'mimes' => '【:attribute】ファイル形式：jpg・jpegのみ対応です。',
        ],[
            'name' => 'ブランド名',
            'description' => '説明',
            'image'=> '画像'
        ]);

        $errors = $validator->errors();

        if(!$errors->has('name') && 
            Category::where('groupbango','=',2)
                    ->where('osusume','=',1)
                    ->where('zokusei','=',request('name'))
                    ->exists()
        ) $errors->add('name','this name already exists.');

        if($errors->any()) return $errors;

        $file_name_to_store = md5(random_bytes(10)).date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();

        $file_path = Storage::disk('category')->getAdapter()->getPathPrefix();
        if(!file_exists($file_path))
        {
            mkdir($file_path, 0777, true);
        }

        Storage::disk('category')->putFileAs('', $request->file('image'), $file_name_to_store);

        $temp = Category::whereNotNull('bango')->orderBy('bango', 'desc')->first();
        if(!$temp) $bango = 1;
        else $bango = $temp->bango + 1;

        $brand = new Category;
        $brand->bango = $bango;
        $brand->zokusei = request('name');
        $brand->patternsub1 = request('description');
        $brand->image1 = $file_name_to_store;
        $brand->groupbango = 2;
        $brand->osusume = 1;
        $brand->save();

        session()->flash('status', "ブランド ".request('name')." 登録しました。");

        return 'ok';
    }

    public function edit ($brand_id)
    {
        $brand = Category::where('groupbango','=',2)
                            ->where('bango','=',$brand_id)
                            ->first();
        return $brand;
    }

    public function update($brand_id,Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required','max:10',new validChar],
            'description' => 'required|max:200',
            'image'=> 'nullable|mimes:jpg|max:5120'
        ],[
            'required' => '【:attribute】必須項目に入力がありません。',
            'max' => '【:attribute】:max文字以内で入力してください。',
            'mimes' => '【:attribute】ファイル形式：jpg・jpegのみ対応です。',
        ],[
            'name' => 'ブランド名',
            'description' => '説明',
            'image'=> '画像'
        ]);

        $errors = $validator->errors();

        if(!$errors->has('name') && 
            Category::where('groupbango','=',2)
                    ->where('osusume','=',1)
                    ->where('bango','<>',$brand_id)
                    ->where('zokusei','=',request('name'))
                    ->exists()
        ) $errors->add('name','this name already exists.');

        if($errors->any()) return $errors;

        $update_array =
                [
                    'zokusei' => request('name'),
                    'patternsub1' => request('description'),
                ];


        if(request('image') != NULL)
        {
            $file_name_to_store = md5(random_bytes(10)).date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();

            $file_path = Storage::disk('category')->getAdapter()->getPathPrefix();
            if(!file_exists($file_path))
            {
                mkdir($file_path, 0777, true);
            }

            Storage::disk('category')->putFileAs('', $request->file('image'), $file_name_to_store);

            $update_array['image1'] = $file_name_to_store;
        }

        Category::where('groupbango','=',2)
                ->where('osusume','=',1)
                ->where('bango','=',$brand_id)
                ->update($update_array);
        $msg = 'ブランド '.request('name').' 更新しました。';
        session()->flash('status', $msg);

        return 'ok';
    }


    public function destroy($brand_id)
    {
        $brand = Category::where('groupbango','=',2)
                            ->where('bango','=',$brand_id)
                            ->first();

        $brand_name = $brand!=NULL ? $brand->zokusei : '';

        if(Product::where('mdjouhou','=',$brand_id)->exists())
            return back()->with('problem', 'brand '.$brand_name.' can not be deleted as there are products.');

        Category::where('groupbango','=',2)
                ->where('bango','=',$brand_id)
                ->update(['osusume' => 0]);

        return back()->with('status', 'ブランド '.$brand_name.' 削除しました。');
    }

    public function restore()
    {
        Category::where('groupbango','=',2)
                ->where('bango','=',request('bango'))
                ->update(['osusume' => 1]);

        $brand = Category::where('groupbango','=',2)
                            ->where('bango','=',request('bango'))
                            ->first();

        $brand_name = $brand!=NULL ? $brand->zokusei : '';
        return back()->with('status', 'Brand '.$brand_name.' restored succesfully!');
    }
}
