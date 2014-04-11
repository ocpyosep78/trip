<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
$is_website = true;
$is_panel = $is_service = false;

$string_link_check = (isset($_SERVER['argv']) && isset($_SERVER['argv'][0])) ? $_SERVER['argv'][0] : '';
$string_link_check = (empty($string_link_check) && isset($_SERVER['REDIRECT_QUERY_STRING'])) ? $_SERVER['REDIRECT_QUERY_STRING'] : $string_link_check;
$url_arg = preg_replace('/(^\/|\/$)/i', '', $string_link_check);
$array_arg = explode('/', $url_arg);

if (count($array_arg) >= 1) {
	$key = $array_arg[0];
	
	if (in_array($key, array( 'panel' ))) {
		$is_panel = true;
		$is_website = false;
	} else if (in_array($key, array( 'service' ))) {
		$is_service = true;
		$is_website = false;
	}
}

if ($is_website) {
	// post
	$route['hotel(/([a-z0-9\-]+))*'] = "website/hotel";
	$route['(destination|restaurant)(/([a-z0-9\-]+))*'] = "website/destination";
	
	// other page
	$route['login/([a-z0-9\-]+)'] = "website/login";
	$route['search(/([a-z0-9\-]+))*'] = "website/search";
	$route['payment(/([a-z0-9\-]+))*'] = "website/payment";
	$route['register(/([a-z0-9\-]+))*'] = "website/register";
	$route['([a-z0-9\-]+)'] = "website/selector";
} else if ($is_panel) {
	$route['panel'] = "panel/home";
} else if ($is_service) {
}

$route['default_controller'] = "website/home";
$route['404_override'] = '';