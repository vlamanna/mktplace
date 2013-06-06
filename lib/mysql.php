<?php

class Mysql
{
	public static $host = '127.0.0.1';
	public static $user = 'root';
	public static $password = 'makaqB11';
	public static $db = 'mktplace';
	public static $port = '3306';
	private static $instance = null;
	
	private static function connect()
	{
		if (!isset($instance)) {
			self::$instance = mysqli_connect(self::$host, self::$user, self::$password, self::$db, self::$port);
			self::$instance->set_charset("utf8");
		}
	}
	
	private static function query($query)
	{
		return self::$instance->query($query);
	}
	
	private static function quoteValue($value)
	{
		return "'" . self::$instance->escape_string($value) . "'";
	}
	
	private static function quoteField($field)
	{
		return "`" . self::$instance->escape_string($field) . "`";
	}
	
	public static function insert($table, $params)
	{
		var_dump($params);
		self::connect();
		
		$fields = array();
		$values = array();
		
		foreach ($params as $field => $value) {
			$fields[] = self::quoteField($field);
			$values[] = self::quoteValue($value);
		}
		
		$fields = implode(",", $fields);
		$values = implode(",", $values);
		
		$query = "
			INSERT INTO `$table` ($fields)
			VALUES ($values)
		";
		
		self::query($query);
		
		return self::$instance->insert_id;
	}
	
	public static function selectOne($table, $params)
	{
		self::connect();
		
		$filters = array();
		
		foreach ($params as $field => $value) {
			$filters[] = self::quoteField($field) . " = " . self::quoteValue($value);
		}
		
		$filters = implode(" AND ", $filters);
		
		$query = "
			SELECT *
			FROM `$table`
			WHERE $filters
			LIMIT 1
		";
		
		$result = self::query($query);
		
		return $result->fetch_assoc();
	}
}