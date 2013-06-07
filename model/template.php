<?php

class Template
{	
	public static function create($userId, $name, $price)
	{
		$templateId = Mysql::insert("templates", array(
			'user_id'		=> $userId,
			'name'			=> $name,
			'price'			=> $price
		));
	}
	
	public static function getList($userId)
	{
		$filters = array();
		
		if (isset($userId)) {
			$filters['user_id'] = $userId;
		}
		
		return Mysql::select("templates", $filters, true);
	}
}