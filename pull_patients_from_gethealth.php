<?php

header('Access-Control-Allow-Origin: *');  
require_once('config/config.php');
require_once('include/gen_functions.php');
error_reporting(E_ALL);

$main_access_token_array = '';

$sql = "select main_access_token from admin_users where status = 'Active' group by main_access_token";

$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($result)) {
    $main_access_token_array[] = $row;
}


foreach($main_access_token_array as $token_value) {
	$main_access_token = $token_value['main_access_token'];
	$data_pull_url = 'https://platform.gethealth.io/v1/health/account/users?access_token='.$main_access_token.'&limit=50&offset=0';
	echo "$data_pull_url <br/>";

	$user_list =  file_get_contents($data_pull_url);
	var_dump($user_list);

	echo "END<br/><hr/>";
	$curr_date = date('Y-m-d h:i:s');

	if ($user_list != '') {
		$user_list_arr = json_decode($user_list, true);
		foreach ($user_list_arr as $key => $value){
			if ($key == 'users') {
				$user_info = $value;
				foreach ($user_info as $key_in => $value_in){
					$access_token =  $value_in['access_token'];
					$gethealthid =  $value_in['gethealthID'];

					echo " Access Token = $access_token  GetHealthId = $gethealthid <br/>";

					$sql = "select id from patients where access_token = '$access_token'";
					$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
					if (mysqli_num_rows($result) == 0) {
						echo "No Rows in DB for $access_token ...Inserting Newly<br/>";
						$sql = "INSERT INTO patients (gethealthid, access_token, created_date, status) values ('$gethealthid' , '$access_token', '$curr_date', 'Active') ";
						mysqli_query($conn,$sql) or die(mysqli_error($conn));
					}
					else {
						echo "Already $access_token exists in DB ... Ignoring Insert<br/>";
					}
					echo "<hr/>";
				}
				
			}
		}
	}
}

?>

