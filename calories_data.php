<?php 
$activites="active";
require_once('config/config.php');
require_once('include/gen_functions.php');
login();
require_once('include/header.php');
require_once('include/header_menu.php');

$display_value=false;
extract($_REQUEST);
if ($gethealthid != '') {
$sql = "select * from calorie_info where gethealthid = '".$gethealthid."' order by timestamp desc LIMIT 0,30";
$display_value = true;
}
else {
  $sql = "select * from calorie_info order by timestamp desc LIMIT 0,300";
  $display_value = false;
}

$result = mysqli_query($conn,$sql) or die("SQL Calorie Selection error".mysqli_error($conn));
$activity_data=array();
$numofrows=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
   $activity_data[]=$row;
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List Calorie Info
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Activities</a></li>
        <li class="active">List Calories Information</li>
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
  $sql = "SELECT * from patients where gethealthid = '".$gethealthid."' ";
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
        <th>GetHealth id</th>
        <th>Source</th>
        <th>Calories</th>
      	<th>TimeStamp</th>
      </tr>
    </thead>
    <tbody>
      <?php
         foreach($activity_data as $details) {
           echo '<tr> 
             <td>'.$details['id'].'</td> 
             <td>'.$details['gethealthid'].'</td>
             <td>'.$details['source'].'</td>
             <td>'.$details['calories'].'</td>
             <td>'.$details['timestamp'].'</td>
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
        "lengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
        "order": [[ 0, "desc" ]]
    } );
});
</script>
