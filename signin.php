<?php

require_once('lib/cookie.php');
require_once('lib/mysql.php');

require_once('model/user.php');

$auth = Cookie::get('auth');

if (isset($auth)) {
	$key = str_replace("MKTPLACE", "", base64_decode($auth));
	
	$user = User::getByKey($key);
	
	if (isset($user)) {
		header('location: /');
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Mktplace - Sign In</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- Le styles -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="/css/mktplace.css" rel="stylesheet">
		
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
		<![endif]-->
		
		<!-- Le fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="/ico/favicon.png">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="/">Mktplace</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="">
								<a href="/">Home</a>
							</li>
							<li class="">
								<a href="/signup">Start Selling</a>
							</li>
							<li class="active">
								<a href="/signin">Sign In</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="main row-fluid">
			<div class="span4 offset4">
				<form class="well form-horizontal" action="/action/signin" method="POST">
					<fieldset>
						<legend>Sign In!</legend>
						<div class="control-group">
							<label class="control-label" for="inputEmail">Email</label>
							<div class="controls">
								<input type="text" id="inputEmail" name="email" placeholder="Email">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputPassword">Password</label>
							<div class="controls">
								<input type="password" id="inputPassword" name="password" placeholder="Password">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Sign In</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		
		<footer class="footer">
			<div class="container">
			<p>Mktplace</p>
			<ul class="footer-links">
				<li><a href="/">Home</a></li>
				<li class="muted">&middot;</li>
				<li><a href="/signup">Start Selling</a></li>
				<li class="muted">&middot;</li>
				<li><a href="/signin">Sign In</a></li>
			</ul>
			</div>
		</footer>
		
		<!-- Le javascript -->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/mktplace.js"></script>
	</body>
</html>