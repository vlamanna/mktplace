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

?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Forgot Password", ""); ?>
	<body>
<?= Document::printNav(TAB_NONE, $connected, ""); ?>
		
		<div class="main row-fluid">
			<div class="span4 offset4">
				<form class="well form-horizontal" action="/action/forgot-password" method="POST">
					<fieldset>
						<legend>Forgot your password?</legend>
						<div class="control-group">
							<label class="control-label" for="inputEmail">Email</label>
							<div class="controls">
								<input type="text" id="inputEmail" name="email" placeholder="Email">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Send Instructions</button>
							</div>
						</div>
					</fieldset>
				</form>
				<div>
					<p>Remember your password? <a href="/signin">Sign in now!</a></p>
				</div>
			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>