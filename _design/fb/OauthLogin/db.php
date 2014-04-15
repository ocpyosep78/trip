<?php
$mysql_hostname = "localhost";
$mysql_user = "suekare1_bromo";
$mysql_password = "ErHpT-,e8roo";
$mysql_database = "trip_db";
$base_url='http://suekarea.com/';

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");
?>