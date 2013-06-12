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
	
		<div class="container">
		
		<div class="subnav row">
			<div class="span12 navbar">
				<ul class="nav">
					<li><a href="#">Bootstrap Themes</a></li>
					<li><a href="#">Email Templates</a></li>
					<li><a href="#">Type 3</a></li>
					<li><a href="#">Type 4</a></li>
				</ul>
			</div>
		</div>
		
		<div class="main row">
			<div class="span10">
<?php foreach ($templates as $template): ?>
				<div class="span2">
					<p><a href="/template/<?= $template['id']; ?>"><b><?= $template['name']; ?></b></a></p>
					<p>$<?= ($template['price'] / 100); ?></p>
				</div>
<?php endforeach; ?>
			</div>
		</div>

		
<?= Document::printFooter($connected); ?>

		</div>

	</body>
</html>