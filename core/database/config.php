<?php
$currency = '₹'; 
$db_username = 'username here';
$db_password = 'password here';
$db_name = 'database name here';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);

mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER_SET utf8");
?>