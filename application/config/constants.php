<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*	SENT MAIL */
$value = ($_SERVER['SERVER_NAME'] == 'localhost') ? false : true;
define('SENT_MAIL',								$value);

/*	LOGIN ACTIVE TIME */
define('LOGIN_ACTIVE_TIME',						(60 * 60 * 1));

define('SHA_SECRET',							'OraNgerti');
define('USER_TYPE_ADMINISTRATOR',				1);
define('USER_TYPE_EDITOR',						2);
define('USER_TYPE_MEMBER',						3);
define('USER_TYPE_TRAVELER',					4);

define('CITY',									'city');
define('CITY_IP',								'city_ip');
define('REGION',								'region');
define('USER',									'user');
define('USER_LOG',								'user_log');
define('USER_TYPE',								'user_type');
