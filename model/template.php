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
	
	public static function update($templateId, $name, $price)
	{
		Mysql::update("templates", $templateId, array(
			'name'			=> $name,
			'price'			=> $price
		));
		
		return self::getBy('id', $userId);
	}
	
	public static function delete($templateId)
	{
		Mysql::delete("templates", array(
			'id'			=> $templateId
		));
		
		return true;
	}
	
	public static function getList($userId)
	{
		$filters = array();
		
		if (isset($userId)) {
			$filters['user_id'] = $userId;
		}
		
		return Mysql::select("templates", $filters, true);
	}
	
	public static function getBy($key, $value)
	{
		return Mysql::select("templates", array(
			$key	=> $value
		), false);
	}
	
	public static function buy($templateId, $userId, $amount)
	{
		Mysql::insert("purchases", array(
			'template_id'	=> $templateId,
			'user_id'		=> $userId,
			'amount'		=> $amount
		));
	}
}