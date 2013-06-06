<?php

class Cookie
{
	public static function set($key, $value)
	{
		$monthDelay = 3600 * 24 * 30;
		
		setcookie($key, $value, time()+$monthDelay, "/");
	}
	
	public static function remove($key)
	{
		setcookie($key, "", time()-3600, "/");
	}
	
	public static function get($key)
	{
		if (isset($_COOKIE[$key])) {
			return $_COOKIE[$key];
		}
		
		return null;
	}
}