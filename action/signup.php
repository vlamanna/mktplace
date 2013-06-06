<?php

require_once('../lib/request.php');
require_once('../lib/cookie.php');
require_once('../lib/mysql.php');

require_once('../model/user.php');

$name = Request::getParam('name');
$email = Request::getParam('email');
$password = Request::getParam('password');

$user = User::create($name, $email, $password);

if (isset($user)) {
	Cookie::set('auth', base64_encode($user['key'] . "MKTPLACE"));
	
	header('location: /account');
} else {
	header('location: /signup');
}