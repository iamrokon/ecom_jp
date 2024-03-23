<?php

namespace App\AllClass\Admin\Customers\All;

use DB;
use App\AllClass\Search;

class Query
{
	public static function base($search_array = [], $sort_column = NULL, $sort_dir = NULL)
	{
		$where_string = "";
		if(is_array($search_array) && count($search_array) >= 1) $where_string = Search::stringify($search_array);
		if($where_string!=NULL) $where_string = " WHERE ". $where_string;
		
		if($sort_column != NULL && $sort_dir != NULL)
		{
			$sort_string = " ORDER BY ". $sort_column . " " . $sort_dir;
		}
		else $sort_string = "";

		DB::statement('DROP TABLE IF EXISTS customer_all');
		DB::statement('DROP TABLE IF EXISTS customer_temp');

		DB::statement("CREATE TEMPORARY TABLE customer_all as
            select
            address as address,
            name as name,
            kaka as kaka,
            mail as mail,
            yubinbango as yubinbango,
            CASE 
            	WHEN CONCAT ( 
	            	COALESCE (kenadd, '') , 
	            	COALESCE (cyouadd, '') , 
	            	COALESCE (biladd, '') 
	            	)='' THEN NULL
	            ELSE CONCAT ( 
	            	COALESCE (kenadd, '') , 
	            	COALESCE (cyouadd, '') , 
	            	COALESCE (biladd, '') 
	            	)
	            END AS details_address,
            model as model,
            tel as tel

            from kaiin
            ");

		DB::statement("CREATE TEMPORARY TABLE customer_temp as
            select * from customer_all
            $where_string $sort_string
            ");
	}

	public static function count()
	{
		return DB::table('customer_temp')->count();
	}

	public static function get()
	{
		return DB::table('customer_temp');
	}
}