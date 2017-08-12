<?php
$dashboard="active";
require_once('config/config.php');    
require_once('include/gen_functions.php');
login();
require_once('include/header.php');
require_once('include/header_menu.php'); 

$active_users = 0;
$inactive_users = 0;

$active_devies = 0;
$inactive_devices = 0;

$sql = "SELECT status, count(*) as cnt from patients group by status";
$result = mysqli_query($conn,$sql) or die("SQL Calorie Selection error".mysqli_error($conn));
$numofrows=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
   if ($row['status'] == 'Active') { $active_users = $row['cnt'];}
   if ($row['status'] == 'InActive') { $inactive_users = $row['cnt'];}
}


$sql = "SELECT conn_status, count(*) as cnt from patient_devices group by conn_status";
$result = mysqli_query($conn,$sql) or die("SQL Calorie Selection error".mysqli_error($conn));
$numofrows=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
   if ($row['conn_status'] == '1') { $active_devices = $row['cnt'];}
   if ($row['conn_status'] == '0') { $inactive_devices = $row['cnt'];}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<h3>Patients Summary</h3>
<div class="row">
        <div class="col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $active_users; ?></h3>

              <p>Active Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer" href="list_patients.php?status=Active">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $inactive_users; ?></h3>

              <p>InActive Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer" href="list_patients.php?status=Inactive">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
	</section>

      <section class="content">
<h3>Devices Summary</h3>
<div class="row">
        <div class="col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $active_devices; ?></h3>

              <p>Connected Devices</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer" href="list_devices.php?status=Active">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $inactive_devices; ?></h3>

              <p>Disconnected Devices</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer" href="list_devices.php?status=Inactive">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
  </section>

</div>