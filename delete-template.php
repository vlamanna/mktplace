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

$templateId = str_replace('/delete-template/', '', $_SERVER['REQUEST_URI']);
$template = Template::getBy('id', $templateId);

if ($user['id'] != $template['user_id']) {
	header('location: /account');
}

?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Delete " . $template['name'], ""); ?>
	<body>
<?= Document::printNav(TAB_NONE, $connected, $user['name']); ?>
		
		<div class="main row-fluid">
			<div class="span4 offset4">
				<form class="well form-horizontal" action="/action/delete-template" method="POST">
					<fieldset>
						<legend>Delete <?= $template['name']; ?>!</legend>
						<input type="hidden" name="template_id" value="<?= $template['id']; ?>">
						<div class="control-group">
							<p>Are you sure you want to delete this template?</p>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Delete</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>