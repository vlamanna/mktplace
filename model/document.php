<?php

define('TAB_NONE', 0);
define('TAB_HOME', 1);
define('TAB_SIGNUP', 2);
define('TAB_SIGNIN', 3);
define('TAB_ACCOUNT', 4);

class Document
{
	public static function printHead($title, $description)
	{
		echo <<< HTML
	<head>
		<meta charset="utf-8">
		<title>$title - Mktplace</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="$description">
		<meta name="author" content="">
		
		<!-- Le styles -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="/css/font-awesome.min.css" rel="stylesheet">
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
HTML;
	}
	
	public static function printNav($activeTab, $connected, $username)
	{
		$homeClass = array();
		$signupClass = array();
		$signinClass = array();
		$accountClass = array();
		$userClass = array("nav", "pull-right");
		
		switch ($activeTab) {
			case TAB_HOME:
				$homeClass[] = "active";
				break;
			case TAB_SIGNUP:
				$signupClass[] = "active";
				break;
			case TAB_SIGNIN:
				$signinClass[] = "active";
				break;
			case TAB_ACCOUNT:
				$accountClass[] = "active";
				break;
			default:
		}
		
		if ($connected) {
			$signupClass[] = "hide";
			$signinClass[] = "hide";
		} else {
			$accountClass[] = "hide";
			$userClass[] = "hide";
		}
		
		$homeClass = implode(" ", $homeClass);
		$signupClass = implode(" ", $signupClass);
		$signinClass = implode(" ", $signinClass);
		$accountClass = implode(" ", $accountClass);
		$userClass = implode(" ", $userClass);
		
		echo <<< HTML
		<div class="row-fluid nav-dark">
			<div class="container">
				<div class="row">
					<div class="span12">
					<div class="navbar">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="/">Mktplace</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="$homeClass">
								<a href="/">Home</a>
							</li>
							<li class="$signupClass">
								<a href="/signup">Start Selling</a>
							</li>
							<li class="$signinClass">
								<a href="/signin">Sign In</a>
							</li>
							<li class="$accountClass">
								<a href="/account">Account</a>
							</li>
						</ul>
						<ul class="$userClass">
							<li class="dropdown">
								<a href="#" class="dropdow-toggle" data-toggle="dropdown">$username <i class="icon-angle-down"></i></a>
								<ul class="dropdown-menu">
									<li>
										<a href="/profile">Profile</a>
										<a href="action/signout">Sign Out</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
HTML;
	}
	
	public static function printFooter($connected)
	{
		$homeClass = array();
		$signinClass = array();
		$signupClass = array();
		$accountClass = array();
		
		if ($connected) {
			$signinClass[] = "hide";
			$signupClass[] = "hide";
		} else {
			$accountClass[] = "hide";
		}
		
		$homeClass = implode(" ", $homeClass);
		$signinClass = implode(" ", $signinClass);
		$signupClass = implode(" ", $signupClass);
		$accountClass = implode(" ", $accountClass);
		
		echo <<< HTML
		<footer class="footer">
			<div class="container">
			<p>Mktplace</p>
			<ul class="footer-links">
			<li class="$homeClass"><a href="/">Home</a></li>
			<li class="$signupClass muted">&middot;</li>
			<li class="$signupClass"><a href="/signup">Start Selling</a></li>
			<li class="$signupClass muted">&middot;</li>
			<li class="$signinClass"><a href="/signin">Sign In</a></li>
			<li class="$accountClass muted">&middot;</li>
			<li class="$accountClass"><a href="/account">Account</a></li>
			</ul>
			</div>
		</footer>
		
		<!-- Le javascript -->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/mktplace.js"></script>
HTML;
	}
}