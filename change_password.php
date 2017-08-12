<?php
$dashboard="active";
  require_once('config/config.php');
  require_once('include/gen_functions.php');
  login();
  require_once('include/header.php');
  require_once('include/header_menu.php');
 	
  ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Change Password
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">

<div class="col-md-12">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
<form action="" method="POST" id="payment-form" class="form-horizontal">
  <div class="row row-centered">
   
         <br>
         <?php
         if(isset($_REQUEST['submit'])){ 
  $admin_id=$_SESSION['admin_id'];
 	$sql = "select password from admin_users  where id = '$admin_id'";
      $exec_sql = mysqli_query($conn,$sql) or die(mysqli_error($conn)); 
  	$row = mysqli_fetch_array($exec_sql) or die(mysqli_error($conn));
  	$user_password=$row['password'];
    extract($_REQUEST); 
     if($user_password!=md5($old_password)){
     echo '<center style="color:red;"> Old password is wrong </center>';
     }
     elseif($new_password!=$confirm_password){
     
     echo '<center style="color:red;"> Password does not match </center>';
     }
     else{
     
 $password=md5($new_password);
     $sql = "update admin_users SET password = '$password'  where id= '$admin_id' ";
     $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
     echo '<center style="color:green;"> Updated successfully </center>';

}
   
 } 
      
?>
<br>
    <div class="form-group">
       <label class="col-sm-4 control-label" for="textinput">Old Password <span class="req">*</span></label>
         <div class="col-sm-6">
            <input type="password"  name="old_password" placeholder="Enter your Old password" class="tsk form-control" >
         </div>
    </div>
    <div class="form-group">
       <label class="col-sm-4 control-label" for="textinput">New Password <span class="req">*</span></label>
         <div class="col-sm-6">
            <input type="password"  name="new_password" placeholder="Enter your New password" class="tsk form-control" >
         </div>
    </div>
    <div class="form-group">
       <label class="col-sm-4 control-label" for="textinput">Confirm Password <span class="req">*</span></label>
         <div class="col-sm-6">
            <input type="password"  name="confirm_password" placeholder="Confirm your New password" class="tsk form-control" >
         </div>
    </div>
 

    <!-- Submit -->
    <div class="control-group" style="margin-top:5%">
      <div class="controls">
        <center>
          <button class="btn btn-success" name="submit" type="submit">Submit</button>
        </center>
        <br>
      </div>
    </div>

</div>
</div>
</form>
</div>

