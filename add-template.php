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
		$connected = true;
	}
}

if (!$connected) {
	header('location: /');
}

?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead("Add a template", ""); ?>
	<body>
<?= Document::printNav(TAB_NONE, $connected, $user['name']); ?>
		
		<div class="main row-fluid">
			<div class="span4 offset4">
				<form class="well form-horizontal" action="/action/add-template" method="POST">
					<fieldset>
						<legend>Add a template!</legend>
						<div class="control-group">
							<label class="control-label" for="inputName">Name</label>
							<div class="controls">
								<input type="text" id="inputName" name="name" placeholder="Name">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputPrice">Price</label>
							<div class="controls">
								<input type="text" id="inputPrice" name="price" placeholder="Price">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Add</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
	</body>
</html>