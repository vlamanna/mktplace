<?php

require_once('lib/cookie.php');
require_once('lib/mysql.php');

require_once('model/user.php');
require_once('model/document.php');
require_once('model/template.php');
require_once('model/category.php');

$connected = false;

$auth = Cookie::get('auth');

if (isset($auth)) {
	$key = str_replace("MKTPLACE", "", base64_decode($auth));
	
	$user = User::getBy('key', $key);
	
	if (isset($user)) {
		$connected = true;
	}
}

$ownerId = str_replace('/designer/', '', $_SERVER['REQUEST_URI']);
$ownerId = explode("-", $ownerId);
$ownerId = $ownerId[0];
$owner = User::getBy('id', $ownerId);

if (!$connected) {
	$user = array(
		'name'	=> ""
	);
}
?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Home", ""); ?>
	<body>
<?= Document::printNav(TAB_NONE, $connected, $user['name']); ?>
	
		<div class="container">
		
<?= Category::printAll(null); ?>
		
		<h1><?= $owner['name']; ?></h1>
		
<?= Template::printAll(null, $owner['id'], null); ?>
		
<?= Document::printFooter($connected); ?>

		</div>

	</body>
</html>