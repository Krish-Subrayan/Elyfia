<?php

header('Access-Control-Allow-Origin: *');  
require_once('config/config.php');
require_once('include/gen_functions.php');
error_reporting(E_ALL);

$access_token_array = '';

$sql = "select uid, access_token from patients where status = 'Active' LIMIT 0,10";

$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($result)) {
    $access_token_array[] = $row;
}


foreach($access_token_array as $token_value) {
	$access_token = $token_value['access_token'];
	$uid = $token_value['uid'];

	$data_pull_url = 'https://platform.gethealth.io/v1/health/user/devices?access_token='.$access_token;
	echo "$data_pull_url <br/>";

	$device_list =  file_get_contents($data_pull_url);
	var_dump($device_list);

	echo "END<br/><hr/>";

	$curr_date = date('Y-m-d h:i:s');

	if ($device_list != '') {
		$device_list_arr = json_decode($device_list, true);
		foreach ($device_list_arr as $key => $value){
			echo "KEY = $key  VALUE = $value<br/>";
			$sql = "DELETE from patient_devices where access_token = '".$access_token."' and uid = '".$uid."' ";
			mysqli_query($conn,$sql) or die(mysqli_error($conn));
			if ($key == 'devices') {
				$device_info = $value;
				foreach ($device_info as $key_in => $value_in){
					$display_name =  sanit_data($value_in['display_name']);
					$name =  sanit_data($value_in['name']);
					$disconnect_url =  urlencode($value_in['disconnect_url']);
					$conn_status =  sanit_data($value_in['conn_status']);
					$connect_url =  urlencode($value_in['connect_url']);
					$logo_url =  urlencode($value_in['logo_url']);
					$description =  sanit_data($value_in['desc']);
					echo " Access Token = $access_token  name = $name  Connection Status = $conn_status<br/>";

					$sql = "INSERT INTO patient_devices (uid, access_token, display_name, name, disconnect_url, conn_status, connect_url, logo_url, description, created_date) values ('$uid' , '$access_token', '$display_name', '$name',  '$disconnect_url',  '$conn_status',  '$connect_url',  '$logo_url',  '$description',  '$curr_date') ";
					mysqli_query($conn,$sql) or die(mysqli_error($conn));
					echo "<hr/>";
				}
			}
		}
		echo "<hr/>";
	} 
}

?>

