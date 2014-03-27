<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session');
$autoload['helper'] = array( 'date', 'common', 'url', 'mcrypt' );
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array(
	'user_model', 'user_type_model', 'city_ip_model', 'user_log_model', 'city_model', 'region_model', 'country_model', 'language_model', 'facility_model',
	'hotel_room_amenity_model', 'ip_banned_model', 'ip_log_model', 'ip_pass_model', 'mass_email_model', 'member_model', 'post_facility_model',
	'post_gallery_model', 'post_model', 'post_traveler_photo_model', 'post_traveler_review_model', 'promo_duration_model', 'promo_model', '',
	'room_amenity_model', 'traveler_model', 'auto_complete_model', 'category_facility_model', 'category_model', 'hotel_star_model',
	'category_sub_model', 'hotel_booking_model', 'hotel_detail_model', 'widget_model', 'page_static_model'
);