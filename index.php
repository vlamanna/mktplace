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
		
		<div class="subnav clearfix">
			<div class="navbar">
				<ul class="nav">
					<li><a href="#">Bootstrap Themes</a></li>
					<li><a href="#">Email Templates</a></li>
					<li><a href="#">Type 3</a></li>
					<li><a href="#">Type 4</a></li>
				</ul>
			</div>
		</div>
		
		<div class="row">
<?php foreach ($templates as $template): ?>
				<div class="span4">
					<div class="padding-10 template-box">
						<div class="template-preview">
							<a href="#" class="button"></a>
							<img src="http://lorempixel.com/560/280/" width="280" height="140" />
							<i class="icon-zoom-in"></i>
						</div>
						<div class="template-title">
						<a href="/template/<?= $template['id']; ?>"><?= $template['name']; ?></a><br/>
						<span class="template-author">By Emma Watson</span>
					</div>
						<div class="template-buy">
							<a href="#" class="button"></a>
							<i class="icon-shopping-cart"></i> $<?= ($template['price'] / 100); ?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
<?php endforeach; ?>
<?php foreach ($templates as $template): ?>
				<div class="span4">
					<div class="padding-10 template-box">
						<div class="template-preview">
							<a href="#" class="button"></a>
							<img src="http://lorempixel.com/560/280/" width="280" height="140" />
							<i class="icon-zoom-in"></i>
						</div>
						<div class="template-title">
						<a href="/template/<?= $template['id']; ?>"><?= $template['name']; ?></a><br/>
						<span class="template-author">By Emma Watson</span>
					</div>
						<div class="template-buy">
							<a href="#" class="button"></a>
							<i class="icon-shopping-cart"></i> $<?= ($template['price'] / 100); ?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
<?php endforeach; ?>
<?php foreach ($templates as $template): ?>
				<div class="span4">
					<div class="padding-10 template-box">
						<div class="template-preview">
							<a href="#" class="button"></a>
							<img src="http://lorempixel.com/560/280/" width="280" height="140" />
							<i class="icon-zoom-in"></i>
						</div>
						<div class="template-title">
						<a href="/template/<?= $template['id']; ?>"><?= $template['name']; ?></a><br/>
						<span class="template-author">By Emma Watson</span>
					</div>
						<div class="template-buy">
							<a href="#" class="button"></a>
							<i class="icon-shopping-cart"></i> $<?= ($template['price'] / 100); ?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
<?php endforeach; ?>
<?php foreach ($templates as $template): ?>
				<div class="span4">
					<div class="padding-10 template-box">
						<div class="template-preview">
							<a href="#" class="button"></a>
							<img src="http://lorempixel.com/560/280/" width="280" height="140" />
							<i class="icon-zoom-in"></i>
						</div>
						<div class="template-title">
						<a href="/template/<?= $template['id']; ?>"><?= $template['name']; ?></a><br/>
						<span class="template-author">By Emma Watson</span>
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