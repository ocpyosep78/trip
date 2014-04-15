<?php
	ob_start("ob_gzhandler");
	
	// error_reporting(0);
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
	session_start();
	
	include 'OauthLogin.php';
	
	$OauthLogin = new OauthLogin();
//	$userSession = $_SESSION['userSession'];