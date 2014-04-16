<?php
	define('BASEPATH', 1);
	
	include 'header.php';
	include '../application/config/constants.php';
	require 'facebook_lib/facebook.php';
	
	// user type
	$user_type = (isset($_GET['user_type'])) ? $_GET['user_type'] : 'traveler';
	
	// link
	$link_login_success = str_replace('[user_type]', $user_type, FB_LOGIN_SUCCESS);
	
	$facebook_scope = 'email,user_birthday'; // Don't modify this
	$facebook_param = array( 'appId'  => FB_APP_ID, 'secret' => FB_APP_SECRET );
	$facebook = new Facebook($facebook_param);
	
	// Connection...
	$user = $facebook->getUser();
	if ($user) {
		$logoutUrl = $facebook->getLogoutUrl();
		try {
			$userData = $facebook->api('/me');
			
			$_SESSION['user_facebook'] = $userData;
			header('Location: '.$link_login_success);
		} catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
			
			sleep(5);
			echo 'Please refresh current page.';
		}
	} else { 
		$loginUrl = $facebook->getLoginUrl(array( 'scope' => $facebook_scope));
		header("Location:$loginUrl");
	}