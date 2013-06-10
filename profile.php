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
<?= Document::printHead("Profile", ""); ?>
	<body>
<?= Document::printNav(TAB_NONE, $connected, $user['name']); ?>
		
		<div class="main row-fluid">
			<div class="span4 offset4">
				<form class="well form-horizontal" action="/action/profile" method="POST">
					<fieldset>
						<legend>Your Profile!</legend>
						<div class="control-group">
							<label class="control-label" for="inputName">Name</label>
							<div class="controls">
								<input type="text" id="inputName" name="name" placeholder="Name" value="<?= $user['name']; ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputEmail">Email</label>
							<div class="controls">
								<input type="text" id="inputEmail" name="email" placeholder="Email" value="<?= $user['email']; ?>">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<a class="btn btn-primary" href="/change-password">Change Password</a>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>