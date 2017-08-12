<?php 
$patients="active";
require_once('config/config.php');
require_once('include/gen_functions.php');
login();
require_once('include/header.php');
require_once('include/header_menu.php');

$sql = "select * from patients order by id desc ";
$result = mysqli_query($conn,$sql) or die("SQL Patients Selection error".mysqli_error($conn));
$patient_data=array();
$numofrows=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
   $patient_data[]=$row;
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List Patients
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Patients</a></li>
        <li class="active">List Patients</li>
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
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">List Patients&nbsp;<a href="create_patient.php"><button class="btn btn-success" >Create New Patient</button></a></h3>
            </div>
<div class="box-body">
  <table class="table list_table1 table-striped table-bordered table2excel " cellspacing="0" width="100%" id="table_payment_list" >
    <thead>
      <tr>
        <th>Action</th>
        <th>DB id</th>
        <th>Patient id</th>
        <th>Access Token</th>
        <th>Get Health Id</th>
      	<th>Status</th>
        <th>Created Time</th>
      </tr>
    </thead>
    <tbody>
      <?php
         foreach($patient_data as $details) {
           echo '<tr> 
             <td style="width:18%;">
              <a style="text-decoration:none;" href="create_patient.php?action=edit&id='.$details['id'].'"> 
                  <button type="edit"   id = '.$details['id'].' > Edit </button> 
              </a>
              <a style="text-decoration:none;" href="create_patient.php?action=delete&id='.$details['id'].'"> 
                  <button type="edit"   id = '.$details['id'].' > Delete </button> 
              </a>
              <a style="text-decoration:none;" href="list_devices.php?access_token='.$details['access_token'].'"> 
                  <button type="view"   id = '.$details['access_token'].' >Dev</button> 
              </a>
              <a style="text-decoration:none;" href="calories_data.php?gethealthid='.$details['gethealthid'].'"> 
                  <button type="view"   id = '.$details['gethealthid'].' >Cal</button> 
              </a>
              <a style="text-decoration:none;" href="steps_data.php?gethealthid='.$details['gethealthid'].'"> 
                  <button type="view"   id = '.$details['gethealthid'].' >Steps</button> 
              </a>
              <a style="text-decoration:none;" href="all_dtls_data.php?gethealthid='.$details['gethealthid'].'&access_token='.$details['access_token'].'"> 
                  <button type="view"   id = '.$details['gethealthid'].' >All Dtls</button> 
              </a>
              </td>
             <td>'.$details['id'].'</td> 
             <td>'.$details['uid'].'</td>
             <td>'.$details['access_token'].'</td>
             <td>'.$details['gethealthid'].'</td>
             <td>'.$details['status'].'</td>
             <td>'.$details['created_date'].'</td>
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
