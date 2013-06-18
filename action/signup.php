<?php

require_once('../lib/request.php');
require_once('../lib/cookie.php');
require_once('../lib/mysql.php');
require_once('../lib/email.php');
require_once('../lib/cakemail.php');

require_once('../model/user.php');

$name = Request::getParam('name');
$email = Request::getParam('email');
$password = Request::getParam('password');

$user = User::create($name, $email, $password);

$personalization = array(
	'name'		=> $name,
	'email'		=> $email
);

$htmlContent = Email::loadEmail('../email/welcome.html', $personalization);
$textContent = Email::loadEmail('../email/welcome.txt', $personalization);

Cakemail::sendEmail($email, 'Welcome to ThemeUp!', $htmlContent, $textContent);

if (isset($user)) {
	Cookie::set('auth', base64_encode($user['key'] . "MKTPLACE"));
	
	header('location: /account');
} else {
	header('location: /signup');
}