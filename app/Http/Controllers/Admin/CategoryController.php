<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\AllClass\Admin\Products\Categories\Query;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Rules\validChar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use File;
use Storage;


class CategoryController extends Controller
{
    public function index()
    {
        $per_page = 15;
        $parent_categories = Category::where('groupbango','=',1)
                                    ->whereNull('category1')
                                    ->where('osusume','=',1)
                                    ->orderBy('bango','ASC')
                                    ->get();
        
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

        $show_categories = Query::get()->paginate($per_page);

        $sortable_headers = [
            'カテゴリ名' => 'zokusei',
            'フロント表示' => 'category2',
            '表示順' => 'suchi1'
        ];

        return view('Admin.category',compact('parent_categories','show_categories','sortable_headers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => [ 'required',new validChar, 'max:10' ],
            'will_display' => [ 'required', 'in:0,1'],
            'serial' => 'nullable|regex:/^[0-9]*$/|max:8',
        ],[
            'required' => '【:attribute】必須項目に入力がありません。',
            'max' => '【:attribute】:max文字以内で入力してください。',
            'serial.regex' => '【:attribute】半角数字以外は使用できません。',
        ],[
            'name' => 'カテゴリ名',
            'will_display' => 'フロント表示',
            'serial' => '表示順',
        ]);

        $errors = $validator->errors();

        if(!$errors->has('name') && self::name_validation(request('name') , NULL , request('parent_id'))) 
            $errors->add('name','this name already exists.');

        if($errors->any()) return $errors;

        $temp = Category::whereNotNull('bango')->orderBy('bango', 'desc')->first();
        if(!$temp) $bango = 1;
        else $bango = $temp->bango + 1;

        $category = new Category;
        $category->bango = $bango;
        $category->zokusei = request('name');
        $category->category1 = request('parent_id');
        $category->category2 = request('will_display');
        $category->suchi1 = request('serial');
        $category->groupbango = 1;
        $category->osusume = 1;
        $category->save();

        if(request('parent_id')!=NULL) $success_message = 'カテゴリ(子) '.request('name').' 登録しました。';
        else $success_message = 'カテゴリ(親) '. request('name').' 登録しました。'; 
        session()->flash('status', $success_message);

        return 'ok';
    }

    public function show ($parent_id)
    {
        $per_page = 15;
        $parent_categories = Category::where('groupbango','=',1)
                                    ->whereNull('category1')
                                    ->where('osusume','=',1)
                                    ->orderBy('bango','ASC')
                                    ->get();

        Query::base(request('search') , request('sort_column') , request('sort_dir') , request('collection') , $parent_id);
        
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

        $show_categories = Query::get()->paginate($per_page);

        $sortable_headers = [
            'カテゴリ名' => 'zokusei',
            'フロント表示' => 'category2',
            '表示順' => 'suchi1'
        ];

        $parent = Category::where('groupbango','=',1)
                            ->where('bango','=',$parent_id)
                            ->first();

        $parent_name = $parent!=NULL ? $parent->zokusei : '';

        return view('Admin.category',compact('parent_categories','show_categories', 'parent_name','sortable_headers'));
    }

    public function edit ($category_id)
    {
        $category = Category::where('groupbango','=',1)
                            ->where('osusume','=',1)
                            ->where('bango','=',$category_id)
                            ->first();
        return $category;
    }

    public function update($category_id, Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => [ 'required',new validChar, 'max:10' ],
            'will_display' => [ 'required', 'in:0,1'],
            'serial' => 'nullable|regex:/^[0-9]*$/|max:8',
        ],[
            'required' => '【:attribute】必須項目に入力がありません。',
            'max' => '【:attribute】:max文字以内で入力してください。',
            'serial.regex' => '【:attribute】半角数字以外は使用できません。',
        ],[
            'name' => 'カテゴリ名',
            'will_display' => 'フロント表示',
            'serial' => '表示順',
        ]);


        $errors = $validator->errors();

        $parent_id = Category::where('groupbango','=',1)
                            ->where('osusume','=',1)
                            ->where('bango','=',$category_id)
                            ->first()->category1;

        if(!$errors->has('name') && self::name_validation(request('name') , $category_id , $parent_id)) 
            $errors->add('name','this name already exists.');

        if($errors->any()) return $errors;

        $update_array =
                [
                    'zokusei' => request('name'),
                    'category2' => request('will_display'),
                    'suchi1' => request('serial'),
                ];


        Category::where('groupbango','=',1)
                ->where('osusume','=',1)
                ->where('bango','=',$category_id)
                ->update($update_array);

        $category = Category::where('groupbango','=',1)
                            ->where('osusume','=',1)
                            ->where('bango','=',$category_id)
                            ->first();

        $category_name = $category!=NULL ? $category->zokusei : '';
        if($category!=NULL && $category->category1==NULL) $category_string = 'カテゴリ(親)';
        else $category_string = 'カテゴリ(子)';

        session()->flash('status', $category_string.' '.$category_name.' 更新しました。');
        return 'ok';
    }

    public function destroy($category_id)
    {
        $category = Category::where('groupbango','=',1)
                            ->where('bango','=',$category_id)
                            ->first();
        $category_name = $category!=NULL ? $category->zokusei : '';

        if(Product::where('name','=',$category_id)->exists() || Product::where('tokuchou','=',$category_id)->exists() )
            return back()->with('problem', 'category '.$category_name.' can not be deleted as there are products.');
        
        Category::where('groupbango','=',1)
                ->where('bango','=',$category_id)
                ->update(['osusume' => 0]);
        
        return back()->with('status', 'カテゴリ '.$category_name.' を削除しました。');
    }

    public function restore()
    {
        Category::where('groupbango','=',1)
                ->where('bango','=',request('bango'))
                ->update(['osusume' => 1]);

        $category = Category::where('groupbango','=',1)
                            ->where('bango','=',request('bango'))
                            ->first();

        $category_name = $category!=NULL ? $category->zokusei : '';
        return back()->with('status', 'Brand '.$category_name.' restored succesfully!');
    }

    public static function name_validation($name , $category_id = NULL , $parent_id = NULL)
    {
        $query = Category::where('groupbango','=',1)
                    ->where('zokusei','=',$name)
                    ->where('osusume','=',1);

        if($category_id != NULL) $query = $query->where('bango','<>',$category_id);
        if($parent_id != NULL) $query = $query->where('category1','=',$parent_id);
        else $query->whereNull('category1');

        return $query->exists();
    }
}
