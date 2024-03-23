<?php

namespace App\AllClass;

class Search
{
	public static function and_glue($strings)
	{
		$return_string = '';
		foreach($strings as $key=>$val)
		{
			if($val!=NULL)
			{
				$return_string .= $val;
				$return_string .= ' AND ';
			}
		}
		$return_string = rtrim($return_string, ' AND ');
		return $return_string;
	}

	public static function is_int_type($db_field)
	{
		if(strpos($db_field, 'int_')!==false) return true;
		return false;
	}

	public static function and_search($key,$val)
	{
		$substring_array = array_filter(explode("+", $val),function($var){return $var!=='';});
		if(count($substring_array)>0)
		{
			$strings = array();
			foreach ($substring_array as $substring)
			{
				$strings[] = $key."::TEXT LIKE '%".$substring."%'";
			}

			return self::and_glue($strings);
		}
		else return "1=2";
	}

	public static function or_search($key,$val,$equal=false)
	{
		$substring_array = array_filter(explode("*", $val),function($var){return $var!=='';});
		if(count($substring_array)>0)
		{
			$return_string = '(';
			foreach ($substring_array as $substring_key => $substring_val)
			{
				if ($substring_key != '0') $return_string .= " OR ";

				if ($equal) $return_string .= $key."='".$substring_val."'";
				else $return_string .= $key."::TEXT LIKE '%".$substring_val."%'";
			}
			$return_string .= ')';

			return $return_string;
		}
		else return "1=1";
	}

	public static function unary_inequality($key,$val)
	{
		if(substr($val, 0, 2)==">=")
		{
			$val = substr($val,2);
			if(!self::is_int_type($key)) $val = "'".$val."'";
			return $key.">=".$val;
		}
		if(substr($val, 0, 2)=="<=")
		{
			$val = substr($val,2);
			if(!self::is_int_type($key)) $val = "'".$val."'";
			return $key."<=".$val;
		}
		if(substr($val, 0, 1)==">")
		{
			$val = substr($val,1);
			if(!self::is_int_type($key)) $val = "'".$val."'";
			return $key.">".$val;
		}
		if(substr($val, 0, 1)=="<")
		{
			$val = substr($val,1);
			if(!self::is_int_type($key)) $val = "'".$val."'";
			return $key."<".$val;
		}
	}

	public static function binary_inequality($key,$val)
	{
		if (strpos($val, ">=")!=false)
		{
			$temp = explode(">=",$val,2);
			if(!self::is_int_type($key))
			{
				$temp[0] = "'".$temp[0]."'";
				$temp[1] = "'".$temp[1]."'";
			}
			return self::and_glue([$key."<=".$temp[0] , $key.">=".$temp[1]]);
		}
		if (strpos($val, "<=")!=false)
		{
			$temp = explode("<=",$val,2);
			if(!self::is_int_type($key))
			{
				$temp[0] = "'".$temp[0]."'";
				$temp[1] = "'".$temp[1]."'";
			}
			return self::and_glue([$key.">=".$temp[0] , $key."<=".$temp[1]]);
		}
		if (strpos($val, ">")!=false)
		{
			$temp = explode(">",$val,2);
			if(!self::is_int_type($key))
			{
				$temp[0] = "'".$temp[0]."'";
				$temp[1] = "'".$temp[1]."'";
			}
			return self::and_glue([$key."<".$temp[0] , $key.">".$temp[1]]);
		}
		if (strpos($val, "<")!=false)
		{
			$temp = explode("<",$val,2);
			if(!self::is_int_type($key))
			{
				$temp[0] = "'".$temp[0]."'";
				$temp[1] = "'".$temp[1]."'";
			}
			return self::and_glue([$key.">".$temp[0] , $key."<".$temp[1]]);
		}
	}

	public static function query($key,$val)
	{
		if(substr($val, 0, 1)=="=")
		{
			$val = substr($val,1);
			if(strpos($val,'*')!==false)
			{
				return self::or_search($key,$val,true);
			}
			else
			{
				if(!empty($val) || $val === '0')
				{
					if(!self::is_int_type($key)) $val = "'".$val."'";
					return $key."=".$val;
				}
				else return $key." IS NULL";
			}
		}

		if(substr($val, 0, 2)=="<>")
		{
			$val = substr($val,2);
			if(strpos($val,'*')!==false)
			{
				$return_string = self::or_search($key,$val,true);
				if ($return_string==NULL) return $return_string;
				return "NOT ".$return_string;
			}
			else
			{
				if(!empty($val) || $val === '0')
				{
					if(!self::is_int_type($key)) $val = "'".$val."'";
					return $key."<>".$val;
				}
				else return $key." IS NOT NULL";
			}
		}

		if(substr($val, 0, 1)==">"||substr($val, 0, 1)=="<")
		{
			return self::unary_inequality($key,$val);
		}

		if(strpos($val, ">")!==false||strpos($val, "<")!==false)
		{
			return self::binary_inequality($key,$val);
		}

		if(strpos($val, "*")!==false)
		{
			return self::or_search($key,$val);
		}

		if(strpos($val, "+")!==false)
		{
			return self::and_search($key,$val);
		}
		return $key."::TEXT LIKE '%".$val."%'";
	}

	public static function stringify($array)
	{
		if(!is_null($array))
		{
			$strings = array();
			foreach($array as $key=>$val)
			{
				if($val!=NULL)
				{
					$val = str_replace("'", "''", $val);
					$strings[] = self::query($key,$val);
				}
			}
			return self::and_glue($strings);
		}
	}
}