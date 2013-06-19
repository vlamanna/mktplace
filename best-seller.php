<?php

require_once('lib/cookie.php');
require_once('lib/mysql.php');

require_once('model/user.php');
require_once('model/document.php');
require_once('model/template.php');
require_once('model/category.php');
require_once('model/tag.php');

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
	$user = array(
		'name'	=> ""
	);
}
?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Home", ""); ?>
	<body>
<?= Document::printNav(TAB_HOME, $connected, $user['name']); ?>
	
		<div class="container">
		
<?= Category::printAll("all"); ?>
		
			<div class="row">
				<div class="span8">
<?= Template::printAll(null, null, null, array('creation_timestamp' => 'DESC')); ?>
				</div>
				<div class="span4">
<?= Tag::printAll(TAG_BEST_SELLER); ?>
				</div>
			</div>
		
<?= Document::printFooter($connected); ?>

		</div>

	</body>
</html>