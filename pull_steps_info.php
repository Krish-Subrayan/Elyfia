<?php

header('Access-Control-Allow-Origin: *');  
require_once('config/config.php');
require_once('include/gen_functions.php');
error_reporting(E_ALL);

$sql = "select main_access_token from admin_users where status = 'Active' group by main_access_token";

$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($result)) {
    $main_access_token_array[] = $row;
}

$curr_date = date('Y-m-d');
//$curr_date = '2017-08-10';
$st_date = $curr_date."T00:00:00";
$end_date = $curr_date."T23:59:59";
$db_date = $curr_date."T00:00:00";

foreach($main_access_token_array as $token_value) {
	$main_access_token = $token_value['main_access_token'];
	$data_pull_url = 'https://platform.gethealth.io/v1/health/account/steps_counts?access_token='.$main_access_token.'&limit=200&start_date='.$st_date.'&end_date='.$end_date;
	echo "$data_pull_url <br/>";

	$data_list =  file_get_contents($data_pull_url);
	var_dump($data_list);

	$curr_date = date('Y-m-d h:i:s');

	if ($data_list != '') {
		$data_list_arr = json_decode($data_list, true);
		foreach ($data_list_arr as $key => $value){
			echo "KEY = $key  VALUE = $value<br/>";
			$sql = "DELETE from steps_info where timestamp = '".$db_date."' ";
			echo $sql."<br/>";
			mysqli_query($conn,$sql) or die(mysqli_error($conn));
			if ($key == 'steps_counts') {
				$calorie_info = $value;
				foreach ($calorie_info as $key_in => $value_in){
					$source =  $value_in['source'];
					$steps_cnt =  $value_in['steps'];
					$gethealthid =  $value_in['gethealthID'];
					$timestamp =  $value_in['timestamp'];

					echo " Souce $source  steps = $steps_cnt  timestamp = $timestamp gethealth  = $gethealthid<br/>";

					$sql = "INSERT INTO steps_info (source, steps_cnt, gethealthid, timestamp) values ('$source' , '$steps_cnt', '$gethealthid', '$timestamp') ";
					mysqli_query($conn,$sql) or die(mysqli_error($conn));
					echo "<hr/>";
				}
			}
		}
		echo "<hr/>";
	} 
}

?>

