<?php

require_once('lib/request.php');
require_once('lib/curl.php');

$ipnPostData = Request::getParams();

// Choose url
if(array_key_exists('test_ipn', $ipnPostData) && 1 === (int) $ipnPostData['test_ipn'])
    $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
else
    $url = 'https://www.paypal.com/cgi-bin/webscr';

$response = Curl::makeSecureCall($url, array('cmd' => '_notify-validate') + $ipnPostData);

if($status == 200 && $response == 'VERIFIED')
{
	if ($ipnPostData['payment_status'] == "Completed") {
		$templateId = $ipnPostData['item_number'];
		$email = $ipnPostData['payer_email'];
		
		$user = User::getBy('email', $email);
		if (!isset($user)) {
			$name = $ipnPostData['first_name'] . " " . $ipnPostData['last_name'];
			$password = md5(time());
			
			$user = User::create($name, $email, $password);
		}
		
		$template = Template::getBy('id', $templateId);
		if (isset($template)) {
			if (($template['price'] / 100) == $ipnPostdata['auth_amount']) {
				Template::buy($template['id'], $user['id'], $template['price']);
			}
		}
	}
}
else
{
    // Not good. Ignore, or log for investigation...
}

?>