<?php

require_once('../lib/request.php');
require_once('../lib/cookie.php');
require_once('../lib/mysql.php');

require_once('../model/user.php');
require_once('../model/template.php');

$connected = false;

$auth = Cookie::get('auth');

if (isset($auth)) {
	$key = str_replace("MKTPLACE", "", base64_decode($auth));
	
	$user = User::getBy('key', $key);
	
	if (isset($user)) {
		$connected = true;
	}
}

if (!$connected) {
	header('location: /');
}

$name = Request::getParam('name');
$email = Request::getParam('email');

User::update($user['id'], $name, $email);

header('location: /profile');