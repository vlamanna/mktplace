<?php

class Mysql
{
	public static $host = '184.72.218.96';
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
	
	public static function update($table, $id, $params)
	{
		self::connect();
		
		$values = array();
		
		foreach ($params as $field => $value) {
			$values[] = self::quoteField($field) . " = " . self::quoteValue($value);
		}
		
		$values = implode(",", $values);
		
		$id = self::quoteValue($id);
		
		$query = "
			UPDATE `$table`
			SET $values
			WHERE `id` = $id
		";
		
		self::query($query);
		
		return true;
	}
	
	public static function delete($table, $params)
	{
		self::connect();
		
		$filters = array();
		
		foreach ($params as $field => $value) {
			$filters[] = self::quoteField($field) . " = " . self::quoteValue($value);
		}
		
		$filters = implode(" AND ", $filters);
		
		$query = "
			DELETE
			FROM `$table`
			WHERE $filters
		";
		
		self::query($query);
		
		return true;
	}
	
	public static function select($table, $params, $list)
	{
		self::connect();
		
		$filters = array();
		$orderBy = "";
		
		foreach ($params as $field => $value) {
			if ($field == "order_by") {
				$orderBy = "ORDER BY " . self::quoteField(key($value)) . " " . current($value);
			} else {
				$filters[] = self::quoteField($field) . " = " . self::quoteValue($value);
			}
		}
		
		if (sizeof($filters) > 0) {
			$filters = "WHERE" . implode(" AND ", $filters);
		}
		
		$limit = "";
		if (!$list) {
			$limit = "LIMIT 1";
		}
		
		$query = "
			SELECT *
			FROM `$table`
			$filters
			$orderBy
			$limit
		";
		
		$result = self::query($query);
		
		if ($list) {
			$results = array();
			
			while ($row = $result->fetch_assoc()) {
				$results[] = $row;
			}
			
			return $results;
		} else {		
			return $result->fetch_assoc();
		}
	}
}