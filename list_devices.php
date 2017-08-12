<?php 
$patients="active";
require_once('config/config.php');
require_once('include/gen_functions.php');
login();
require_once('include/header.php');
require_once('include/header_menu.php');

$display_value=false;

extract($_REQUEST);
if ($access_token != '') {
$sql = "select * from patient_devices where access_token = '".$access_token."' ";
$display_value=true;
}
else {
  $sql = "select * from patient_devices order by access_token ";
  $display_value=false;
}

$result = mysqli_query($conn,$sql) or die("SQL Patients Selection error".mysqli_error($conn));
$device_data=array();
$numofrows=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
   $device_data[]=$row;
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List Devices
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Devices</a></li>
        <li class="active">List Devices</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">

<div class="col-md-12">
 <?php
if( isset($_SESSION['status'])){
    echo '<center><div style="width:50%;" class="callout callout-info">'.$_SESSION['status'].'</div></center>';
    unset($_SESSION['status']);
}


?>
<div class="row">
<div class="col-md-12">
<?php
if ($display_value == true) {
  $sql = "SELECT * from patients where access_token = '".$access_token."' ";
  $result = mysqli_query($conn,$sql) or die("SQL Calorie Selection error".mysqli_error($conn));
  $dt=mysqli_fetch_array($result);
  echo "<h6> Patient = [".$dt['uid']."] <br/>Access Token = [".$dt['access_token']."] <br/>GetHealthId = [".$dt['gethealthid']."] </h6>";
}
?>
</div></div>

<div class="box box-primary">
<div class="box-body">
  <table class="table list_table1 table-striped table-bordered table2excel " cellspacing="0" width="100%" id="table_payment_list" >
    <thead>
      <tr>
        <th>DB id</th>
        <th>Patient id</th>
        <th>Access Token</th>
        <th>Device Name</th>
      	<th>Conn Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
         foreach($device_data as $details) {
           echo '<tr> 
             <td>'.$details['id'].'</td> 
             <td>'.$details['uid'].'</td>
             <td>'.$details['access_token'].'</td>
             <td>'.$details['display_name'].'</td>
             <td>'.$details['conn_status'].'</td>
           </tr>';
          }    
      ?>
     </tbody>
   </table>
  </div>
</div>

<script>
$(document).ready(function(){
$('.table').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
});
</script>
