<?php

require_once('lib/cookie.php');
require_once('lib/mysql.php');

require_once('model/user.php');
require_once('model/document.php');

$connected = false;

$auth = Cookie::get('auth');

if (isset($auth)) {
	$key = str_replace("MKTPLACE", "", base64_decode($auth));
	
	$user = User::getBy('key', $key);
	
	if (isset($user)) {
		header('location: /');
	}
}

$userKey = str_replace('/reset-password/', '', $_SERVER['REQUEST_URI']);
$user = User::getBy('key', $userKey);

if (!isset($user)) {
	header('location: /');
}

?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Reset Password", ""); ?>
	<body>
<?= Document::printNav(TAB_NONE, $connected, ""); ?>
		
		<div class="main row-fluid">
			<div class="span4 offset4">
				<form class="well form-horizontal" action="/action/reset-password" method="POST">
					<fieldset>
						<legend>Reset your Password!</legend>
						<input type="hidden" name="key" value="<?= $user['key']; ?>">
						<div class="control-group">
							<label class="control-label" for="inputPassword">Password</label>
							<div class="controls">
								<input type="password" id="inputPassword" name="password" placeholder="Password">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputConfirmPassword">Confirm Password</label>
							<div class="controls">
								<input type="password" id="inputConfirmPassword" name="confirm_password" placeholder="Confirm Password">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Reset Password</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>