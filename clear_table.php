<?php

session_start();

include_once 'core/database/config.php';
include_once 'core/init.php';

 
 $table_no = $_GET["table_no"];
$return_url = base64_decode($_GET["return_url"]);


	add_kot_to_bill($table_no);
	
	add_kot_to_kotb($table_no);
	
	delete_all_kot($table_no);

header('Location:'.$return_url);



?>