<?php

namespace App\AllClass\Admin\Products\Categories;

use DB;
use App\AllClass\Search;

class Query
{
	public static function base($search_array = [], $sort_column = NULL, $sort_dir = NULL, $collection = NULL, $parent_id = NULL)
	{
		$where_string = "";

		if($collection=='trashed') $search_array['osusume'] = '=0';
		else $search_array['osusume'] = '=1';

		$search_array['groupbango'] = '=1';

		if($parent_id!=NULL) $search_array['category1'] = '='.$parent_id;
		else $search_array['category1'] = '=';

		if(is_array($search_array) && count($search_array) >= 1) $where_string = Search::stringify($search_array);
		if($where_string!=NULL) $where_string = " WHERE ". $where_string;
		
		if($sort_column != NULL && $sort_dir != NULL)
		{
			$sort_string = " ORDER BY ". $sort_column . " " . $sort_dir;
		}
		else $sort_string = " ORDER BY bango ASC";

		DB::statement('DROP TABLE IF EXISTS categories_all');
		DB::statement('DROP TABLE IF EXISTS categories_temp');

		DB::statement("CREATE TEMPORARY TABLE categories_all as
            select
            bango as bango,
            zokusei as zokusei,
            category1 as category1,
            CASE 
				WHEN category2='1'  THEN '表示'
				ELSE '非表示'
			END as category2,
            osusume as osusume,
			groupbango as groupbango,
			suchi1 as suchi1

            from categorykanri
            ");

		DB::statement("CREATE TEMPORARY TABLE categories_temp as
            select * from categories_all
            $where_string $sort_string
            ");
	}

	public static function count()
	{
		return DB::table('categories_temp')->count();
	}

	public static function get()
	{
		return DB::table('categories_temp');
	}
}