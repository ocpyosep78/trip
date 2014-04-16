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

/*   SENT MAIL   */
$value = ($_SERVER['SERVER_NAME'] == 'localhost') ? false : true;
define('SENT_MAIL',								$value);

/*   LOGIN ACTIVE TIME   */
define('LOGIN_ACTIVE_TIME',						(60 * 60 * 1));

/*   LANGUAGE DEFAULT   */
define('LANGUAGE_DEFAULT',						'en');

/*	MAXIMUM IP ACCESS PER HOUR */
define('MAXIMUM_IP_ACCESS_PER_HOUR',			1000);

/*	VERIFY ADDRESS MAX */
define('VERIFY_ADDRESS_MAX',					5);

/*	PROMO REMINDER   */
define('PROMO_REMINDER',						'+1 Month');

/*	WEBSITE INFO */
define('WEBSITE_TITLE',							'Website Trip');
define('WEBSITE_ALIAS',							'website trip');
define('WEBSITE_COOKIE',						'.suekarea.com');

/*	FACEBOOK INFO */
define('FB_APP_ID',								'674480649266643');
define('FB_APP_SECRET',							'596a165dad8c22cfa86706877ca41554');
define('FB_LOGIN_SUCCESS',						'http://tripdomestik.com/login/[user_type]/fb');

define('CATEGORY_HOTEL',						1);
define('CATEGORY_DESTINATION',					2);
define('CATEGORY_RESTAURANT',					3);

define('SHA_SECRET',							'OraNgerti');
define('USER_TYPE_ADMINISTRATOR',				99);
define('USER_TYPE_EDITOR',						88);
define('USER_TYPE_MEMBER',						77);
define('USER_TYPE_TRAVELER',					66);

define('AUTO_COMPLETE',							'auto_complete');
define('CATEGORY',								'category');
define('CATEGORY_FACILITY',						'category_facility');
define('CATEGORY_SUB',							'category_sub');
define('CATEGORY_TAG',							'category_tag');
define('CITY',									'city');
define('CITY_IP',								'city_ip');
define('COUNTRY',								'country');
define('FACILITY',								'facility');
define('HOTEL_BOOKING',							'hotel_booking');
define('HOTEL_DETAIL',							'hotel_detail');
define('HOTEL_ROOM_AMENITY',					'hotel_room_amenity');
define('IP_BANNED',								'ip_banned');
define('IP_LOG',								'ip_log');
define('IP_PASS',								'ip_pass');
define('LANGUAGE',								'language');
define('MASS_EMAIL',							'mass_email');
define('MEMBER',								'member');
define('MEMBERSHIP',							'membership');
define('NEWSLETTER',							'newsletter');
define('PAGE_STATIC',							'page_static');
define('PAYMENT',								'payment');
define('POST',									'post');
define('POST_FACILITY',							'post_facility');
define('POST_GALLERY',							'post_gallery');
define('POST_TAG',								'post_tag');
define('POST_TRAVELER_PHOTO',					'post_traveler_photo');
define('POST_TRAVELER_REPORT',					'post_traveler_report');
define('POST_TRAVELER_REVIEW',					'post_traveler_review');
define('PROMO',									'promo');
define('PROMO_DURATION',						'promo_duration');
define('REGION',								'region');
define('ROOM_AMENITY',							'room_amenity');
define('TAG',									'tag');
define('TRAVELER',								'traveler');
define('USER',									'user');
define('USER_LOG',								'user_log');
define('USER_MEMBERSHIP',						'user_membership');
define('USER_SETTING',							'user_setting');
define('USER_TYPE',								'user_type');
define('VERIFY_ADDRESS',						'verify_address');
define('WIDGET',								'widget');
