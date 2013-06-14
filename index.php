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

$templates = Template::getList(null, null);

$categories = Category::getList();

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
		
		<div class="subnav clearfix">
			<div class="navbar">
				<ul class="nav">
					<li class="active"><a href="/">All</a></li>
<?php foreach ($categories as $category): ?>
					<li><a href="/category/<?= str_replace(" ", "-", strtolower($category['name'])); ?>"><?= $category['name']; ?></a></li>
<?php endforeach; ?>
				</ul>
			</div>
		</div>
		
		<div class="row">
<?php foreach ($templates as $template): ?>
<?php
	$templateOwner = User::getBy('id', $template['user_id']);
?>
				<div class="span4">
					<div class="padding-10 template-box">
						<div class="template-preview">
							<a href="#" class="button"></a>
							<img src="http://lorempixel.com/560/280/" width="280" height="140" />
							<i class="icon-zoom-in"></i>
						</div>
						<div class="template-title">
						<a href="/template/<?= $template['id'] . "-" . str_replace(" ", "-", strtolower($template['name'])); ?>"><?= $template['name']; ?></a><br/>
						<span class="template-author">By <?= $templateOwner['name']; ?></span>
					</div>
						<div class="template-buy">
							<a href="#" class="button"></a>
							<i class="icon-shopping-cart"></i> $<?= ($template['price'] / 100); ?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
<?php endforeach; ?>
		</div>

		
<?= Document::printFooter($connected); ?>

		</div>

	</body>
</html>