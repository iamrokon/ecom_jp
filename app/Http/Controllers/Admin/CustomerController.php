<?php

namespace App\Http\Controllers\Admin;

use App\AllClass\Admin\Customers\All\Query;
use App\Http\Controllers\Controller;
use App\Model\Kaiin;
use Illuminate\Pagination\Paginator;
use DB;
use App\AllClass\Search;


class CustomerController extends Controller
{
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

        $kaiins = Query::get()->paginate($per_page);

		$sortable_headers = [
		    '国/地域' => 'address' ,
		    '氏名' => 'name' ,
		    'フリガナ' => 'kaka' ,
		    'メールアドレス' => 'mail' ,
		    '郵便番号' => 'yubinbango' ,
		    '住所' => 'details_address' ,
		    '会社名' => 'model' ,
		    '電話番号' => 'tel' ,
		];

        return view('Admin.customers',compact('kaiins' , 'sortable_headers'));
	}
}