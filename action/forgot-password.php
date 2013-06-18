<?php

require_once('../lib/request.php');
require_once('../lib/mysql.php');
require_once('../lib/email.php');
require_once('../lib/cakemail.php');

require_once('../model/user.php');

$email = Request::getParam('email');

$user = User::getBy('email', $email);

if (!isset($user)) {
	header('location: /forgot-password');
}

$personalization = array(
	'name'		=> $user['name'],
	'email'		=> $email,
	'key'		=> $user['key']
);

$htmlContent = Email::loadEmail('../email/reset-password.html', $personalization);
$textContent = Email::loadEmail('../email/reset-password.txt', $personalization);

Cakemail::sendEmail($email, 'Reset your password', $htmlContent, $textContent);

header('location: /forgot-password');