<?php

class User
{
	private static function generateKey($email)
	{
		return md5($email . time());
	}
	
	private static function hashPassword($password)
	{
		return md5($password . "MKTPLACE");
	}
	
	public static function create($name, $email, $password) {
		$userId = Mysql::insert("users", array(
			'key'			=> self::generateKey($email),
			'name'			=> $name,
			'email'			=> $email,
			'password_hash'	=> self::hashPassword($password)
		));
		
		return Mysql::selectOne("users", array(
			'id'		=> $userId
		));
	}
	
	public static function authenticate($email, $password) {
		return Mysql::selectOne("users", array(
			'email'			=> $email,
			'password_hash'	=> self::hashPassword($password)
		));
	}
	
	public static function getByKey($key) {
		return Mysql::selectOne("users", array(
			'key'			=> $key
		));
	}
}