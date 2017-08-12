<?php

header('Access-Control-Allow-Origin: *');  
require_once('config/config.php');
require_once('include/gen_functions.php');
error_reporting(E_ALL);


$data_pull_url = 'https://platform.gethealth.io/v1/health/account/users?access_token='.$_SESSION['main_access_token'];

echo "New <br/><hr/>";
$user_list =  file_get_contents($data_pull_url);
echo "New <br/><hr/>";

if ($user_list != '') {
	$user_list_arr = json_decode($user_list, true);
	foreach ($return_arr as $key => $value){
		echo "KEY = $key VALUE = $value <br/>";
	}
}



?>

