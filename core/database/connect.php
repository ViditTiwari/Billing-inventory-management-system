<?php
$connect_error='Sorry, we\'re experiencing connection problems.';
mysql_connect('localhost','username here','password here') or die(mysql_error());


mysql_select_db('database name here') or die($connect_error);

?>