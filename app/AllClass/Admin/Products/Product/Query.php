<?php

namespace App\AllClass\Admin\Products\Product;

use DB;
use App\AllClass\Search;

class Query
{
	public static function base($search_array = [], $sort_column = NULL, $sort_dir = NULL)
	{
		$where_conditions = Search::stringify($search_array);
		
		if($where_conditions!="") $where_string = " where ". $where_conditions;
		else $where_string = NULL;

		if($sort_column != NULL && $sort_dir != NULL)
		{
			$sort_string = " ORDER BY ". $sort_column . " " . $sort_dir;
		}
		else $sort_string = " ORDER BY bango ASC ";

		DB::statement('DROP TABLE IF EXISTS product_all');
		DB::statement('DROP TABLE IF EXISTS product_temp');

		DB::statement("CREATE TEMPORARY TABLE product_all as
            select
            syouhin1.bango as bango,
            syouhin1.jouhou as jouhou,
            syouhin1.mdjouhou as mdjouhou,
            syouhin1.kokyakusyouhinbango as kokyakusyouhinbango,
			syouhin1.kongouritsu as kongouritsu,
			syouhin1.koyuujouhou as koyuujouhou,
			syouhin1.data50 as data50,
			syouhin1.size as size,
			syouhin1.color as color,
			syouhin1.kakaku as int_kakaku,
			syouhin1.data23 as data23,
			syouhin1.datatxt0107 as datatxt0107,
			syouhin1.datatxt0108 as datatxt0108,
			syouhin1.synchrosyouhinbango as int_synchrosyouhinbango,
			CASE 
				WHEN syouhin1.isdaihyou = 1 THEN '表示する'
				WHEN syouhin1.isdaihyou = 0 THEN '表示しない'
				ELSE NULL
			END as isdaihyou,
			CASE 
				WHEN syouhin1.endtime = 1 THEN '出店する'
				WHEN syouhin1.endtime = 0 THEN '出店しない'
				ELSE NULL
			END as endtime,
			CASE 
				WHEN syouhin1.code1 = '1' THEN 'する'
				WHEN syouhin1.code1 = '0' THEN 'しない'
				ELSE NULL
			END as code1,
			syouhin1.datatxt0106 as datatxt0106,
			syouhin1.isphoto as int_isphoto,
			kokyaku1.name as kokyaku_name,
			gazou.url as picture,
			parent_category.zokusei as parent_category_zokusei,
			child_category.zokusei as child_category_zokusei,
			syouhin2.genka as int_genka,
			syouhin3.syouhizeiritu as int_syouhizeiritu

            from syouhin1

            left join kokyaku1 on kokyaku1.bango = syouhin1.kokyakubango::INTEGER

            left join categorykanri as parent_category on parent_category.bango = syouhin1.data51::INTEGER

            left join categorykanri as child_category on child_category.bango = syouhin1.data52::INTEGER

            left join gazou on gazou.syouhinbango = syouhin1.bango

            join syouhin2 on syouhin1.bango = syouhin2.bango

            join syouhin3 on syouhin1.bango = syouhin3.bango

            WHERE syouhin1.isphoto IS DISTINCT FROM 1
            ");

		DB::statement("CREATE TEMPORARY TABLE product_temp as
            select * from product_all
            $where_string $sort_string
            ");
	}

	public static function count()
	{
		return DB::table('product_temp')->count();
	}

	public static function get()
	{
		return DB::table('product_temp');
	}
}