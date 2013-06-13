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

$templateId = str_replace('/template/', '', $_SERVER['REQUEST_URI']);
$template = Template::getBy('id', $templateId);

?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead($template['name'], ""); ?>
	<body>
<?= Document::printNav(TAB_NONE, $connected, $user['name']); ?>
		
		<div class="main row-fluid">
			<div class="span10 offset1">
				<h2><?= $template['name']; ?></h2>
				<p>$<?= ($template['price']/100); ?></p>
				<p>
					<script src="/js/paypal-button.min.js?merchant=vincent_lamanna@hotmail.com"
						data-button="buynow"
						data-name="<?= $template['name']; ?>"
						data-number="<?= $template['id']; ?>"
						data-currency="USD"
						data-amount="<?= ($template['price']/100); ?>"
					></script>
				</p>
			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>