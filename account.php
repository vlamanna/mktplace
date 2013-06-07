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

if (!$connected) {
	header('location: /');
}

$templates = Template::getList($user['id']);

?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Account", ""); ?>
	<body>
<?= Document::printNav(TAB_ACCOUNT, $connected, $user['name']); ?>
		
		<div class="main row-fluid">
			<div class="span10 offset1">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#templates" data-toggle="tab">My Templates</a>
					</li>
					<li>
						<a href="#purchases" data-toggle="tab">My Purchases</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="templates">
						<a href="add-template" class="btn btn-primary">Add a template</a>
						<br><br>
<?php if (sizeof($templates) == 0): ?>
						<p>You haven't added any templates yet.</p>
<?php else: ?>
<?php foreach ($templates as $template): ?>
						<div class="span2 well">
							<p><b><?= $template['name']; ?></b></p>
							<p>$<?= ($template['price'] / 100); ?></p>
						</div>
<?php endforeach; ?>
<?php endif; ?>
					</div>
					<div class="tab-pane fade" id="purchases">
						<p>You haven't bought any template yet.</p>
					</div>
				</div>
			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>