<?php

require_once('lib/cookie.php');
require_once('lib/mysql.php');

require_once('model/user.php');
require_once('model/document.php');
require_once('model/template.php');

$connected = false;

$auth = Cookie::get('auth');

if (isset($auth)) {
	$key = str_replace("MKTPLACE", "", base64_decode($auth));
	
	$user = User::getBy('key', $key);
	
	if (isset($user)) {
		$connected = true;
	}
}

$templates = Template::getList(null);

?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Home", ""); ?>
	<body>
<?= Document::printNav(TAB_HOME, $connected, $user['name']); ?>
		
		<div class="main row-fluid">
			<div class="span10 offset1">
<?php foreach ($templates as $template): ?>
				<div class="span2 well">
					<p><b><?= $template['name']; ?></b></p>
					<p>$<?= ($template['price'] / 100); ?></p>
				</div>
<?php endforeach; ?>
			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>