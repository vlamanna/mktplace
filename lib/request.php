<?php

class Request
{
	public static function getParam($name)
	{
		if (isset($_POST[$name])) {
			return $_POST[$name];
		}
		
		return null;
	}
	
	public static function getParams()
	{
		return $_POST;
	}
}