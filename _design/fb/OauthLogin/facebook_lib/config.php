<?php
//Facebook Application Configuration.
$facebook_appid='674480649266643';
$facebook_app_secret='596a165dad8c22cfa86706877ca41554';
$facebook_scope='email,user_birthday'; // Don't modify this

$facebook = new Facebook(array(
'appId'  => $facebook_appid,
'secret' => $facebook_app_secret,
));
?>
