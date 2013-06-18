<?php

class Email
{
	public static function loadEmail($fileName, $personalization)
	{
		$content = file_get_contents($fileName);
		
		$searches = array();
		$replaces = array();
		foreach ($personalization as $search => $replace) {
			$searches[] = "{{ $search }}";
			$replaces[] = $replace;
		}
		
		return str_replace($searches, $replaces, $content);
	}
}