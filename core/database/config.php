<?php
$currency = '₹'; 
$db_username = 'root';
$db_password = 'shabdvriksh';
$db_name = 'cdbms';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);

mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER_SET utf8");
?>