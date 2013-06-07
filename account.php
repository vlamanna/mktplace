<?php

require_once('lib/cookie.php');
require_once('lib/mysql.php');

require_once('model/user.php');
require_once('model/document.php');

$connected = false;

$auth = Cookie::get('auth');

if (isset($auth)) {
	$key = str_replace("MKTPLACE", "", base64_decode($auth));
	
	$user = User::getByKey($key);
	
	if (isset($user)) {
		$connected = true;
	}
}

if (!$connected) {
	header('location: /');
}

?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Account", ""); ?>
	<body>
<?= Document::printNav(TAB_ACCOUNT, $connected, $user['name']); ?>
		
		<div class="container">
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>