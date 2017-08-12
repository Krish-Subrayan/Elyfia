<?php

if ($gbl_environment == 'production') {
	$host = 'localhost';
	$user = 'elyfia';
	$password = 'goodday123';
	$database = 'db_elyfia';
} else if ($gbl_environment == 'development') {
	$host = 'localhost';
	$user = 'axecode8_elyfia';
	$password = 'Print@789';
	$database = 'axecode8_elyfia';
} else if ($gbl_environment == 'local_mode') {
	$host = 'localhost';
	$user = 'elyfia';
	$password = 'Print@789';
	$database = 'elyfia';
}
 
$conn=mysqli_connect($host,$user,$password,$database)  or die('error:'.mysqli_connect_error());

?>

