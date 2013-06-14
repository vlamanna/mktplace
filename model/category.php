<?php

class Category
{	
	public static function getList()
	{
		return Mysql::select("categories", array(), true);
	}
	
	public static function getBy($key, $value)
	{
		return Mysql::select("categories", array(
			$key	=> $value
		), false);
	}
}