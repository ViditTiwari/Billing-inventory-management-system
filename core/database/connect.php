<?php
$connect_error='Sorry, we\'re experiencing connection problems.';
mysql_connect('localhost','root','shabdvriksh') or die(mysql_error());


mysql_select_db('cdbms') or die($connect_error);

?>