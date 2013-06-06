<?php

require_once('../lib/cookie.php');

Cookie::remove('auth');

header('location: /');