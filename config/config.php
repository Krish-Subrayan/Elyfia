<?php
session_start();
ob_start();
error_reporting(0);

$gbl_site_name = 'Elyfia';

// set either development or production // uncomment either one line below.
//$gbl_environment = 'development';
$gbl_environment = 'local_mode';
//$gbl_environment = 'production';

if ($gbl_environment == 'production') {
    //set files related to production server
    $gbl_base_url = 'http://elyfia.com/';

} else if ($gbl_environment == 'development') {
    //set files related to development server
    $gbl_base_url = 'http://elyfia.axecode.in/';

} else if ($gbl_environment == 'local_mode') {
    //set files related to local server
    $gbl_base_url = 'http://local.elyfia.com/';
}

require_once('admin_db.php');


$gbl_from_email_id = "admin@elyfia.com";
$gbl_from_email_name = "Elyfia Admin";
$gbl_to_admin_email = "admin@elyfia.com";
$gbl_to_receipt_email = "receipt@elyfia.com";

date_default_timezone_set('Europe/Copenhagen');

$gbl_user_agent_api_key = 'a160cc88';

?>
