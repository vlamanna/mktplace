<?php

require_once('../lib/request.php');
require_once('../lib/cookie.php');
require_once('../lib/mysql.php');

require_once('../model/user.php');

$userKey = Request::getParam('key');
$password = Request::getParam('password');

$user = User::getBy('key', $userKey);

if (!isset($user)) {
	header('location: /');
}

User::changePassword($user['id'], $password);

Cookie::set('auth', base64_encode($user['key'] . "MKTPLACE"));

header('location: /account');