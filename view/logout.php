<?php

	session_start();
	session_destroy();
	header("location: auth/login.php");
	
//	$cookie_name = 'uname';
//	unset($_COOKIE[$cookie_name]);
	// empty value and expiration one hour before
//	$res = setcookie($cookie_name, '', time() - 3600);
	
