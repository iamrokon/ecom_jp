<?php

namespace App\AllClass\Admin\Products\Brands;

use DB;
use App\AllClass\Search;

class Query
{
	public static function base($search_array = [], $sort_column = NULL, $sort_dir = NULL, $collection = NULL)
	{
		$where_string = "";

		if($collection=='trashed') $search_array['osusume'] = '=0';
		else $search_array['osusume'] = '=1';

		$search_array['groupbango'] = '=2';

		if(is_array($search_array) && count($search_array) >= 1) $where_string = Search::stringify($search_array);
		if($where_string!=NULL) $where_string = " WHERE ". $where_string;
		
		if($sort_column != NULL && $sort_dir != NULL)
		{
			$sort_string = " ORDER BY ". $sort_column . " " . $sort_dir;
		}
		else $sort_string = " ORDER BY bango ASC";

		DB::statement('DROP TABLE IF EXISTS brands_all');
		DB::statement('DROP TABLE IF EXISTS brands_temp');

		DB::statement("CREATE TEMPORARY TABLE brands_all as
            select
            bango as bango,
            image1 as image1,
            patternsub1 as patternsub1,
            zokusei as zokusei,
            osusume as osusume,
			groupbango as groupbango

            from categorykanri
            ");

		DB::statement("CREATE TEMPORARY TABLE brands_temp as
            select * from brands_all
            $where_string $sort_string
            ");
	}

	public static function count()
	{
		return DB::table('brands_temp')->count();
	}

	public static function get()
	{
		return DB::table('brands_temp');
	}
}