<?php
$users="active";
require_once('config/config.php');
require_once('include/gen_functions.php');
login();

require_once('include/header.php');
require_once('include/header_menu.php');
extract($_REQUEST); 

$err = 'none';
$date = date("Y-m-d H:i:s");

if(isset($_REQUEST['insert_admin'])) {       
  
  $sql = "SELECT * FROM admin_users where email='".$email."'";
  $query = mysqli_query( $conn,$sql) or die("Insert admin Error".mysqli_error($conn)); 
  $rowcount_email = mysqli_num_rows($query);                      
  
  if ($rowcount_email>0){
      $emailErr = 'Email already been used';
      $err = 'block';
   }else{
      
      $sql = "INSERT INTO admin_users 
                (name, email, password, status,created , level) 
                values (
                '" . $name . "',
                '" . $email . "',
                '" . md5($password) . "',
                'Active',
                '" . $date . "' ,
                '" . $level . "'
                )";

      $query = mysqli_query( $conn,$sql) or die("Insert admin Error".mysqli_error($conn));
      $_SESSION['status'] = "Admin user created successfully";

      header('Location: Administrators.php'); 
      exit;
    }           
} // $_REQUEST(insert)

$function = 'Create';
if(isset($_GET['id'])) {     
      $sql = "SELECT * FROM admin_users where id='".$_GET['id']."'";
      $query = mysqli_query( $conn,$sql) or die("Insert admin Error".mysqli_error($conn));                       
      while($row_webid = mysqli_fetch_array($query)){
          $name = $row_webid['name'];
          $level = $row_webid['level'];
          $emaildata = $row_webid['email'];          
      }
      $function = 'Edit';
} // get admin user value by id

if(isset($_GET['deleteid'])) {           
      $sql = "UPDATE admin_users 
               SET 
               status = 'Inactive'               
              WHERE 
                id ='".$_GET['deleteid']."'
                ";
      $query = mysqli_query( $conn,$sql) or die("Insert admin Error".mysqli_error($conn));                             
      $_SESSION['status'] = "Deleted admin user successfully";  
      header('Location: Administrators.php'); 
      exit;
} // delete admin user value by id

if(isset($_REQUEST['update_admin'])) { 
  $emailErr = '';
  if ($oldemail!=$email){
    $sql = "SELECT * FROM admin_users where email='".$email."'";
    $query = mysqli_query( $conn,$sql) or die("Insert admin Error".mysqli_error($conn)); 
    $rowcount_email = mysqli_num_rows($query);                      
    if ($rowcount_email>0){
      $emailErr = 'Email already been used';
      $err = 'block';
    }
  } 

  if ($emailErr==""){
    $sql = "UPDATE admin_users 
               SET 
               name = '".$name."',
               email = '".$email."',
               level = '".$level."',
               status = '".$status."'
              WHERE 
                id ='".$_GET['id']."'
                ";
    
    mysqli_query($conn,$sql) or die('UPDATE admin_users Error'.mysqli_error($conn)); 
    $_SESSION['status'] = "Admin user updated successfully";
    header('Location: Administrators.php'); 
    exit;
  }            
      
} // $_REQUEST(insert)

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$function?> Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active"><?=$function?> Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">

<div class="col-md-12">
<div class="box box-primary">
<?php
if (!isset($_GET['id'])){
?>  
            <div class="box-header with-border">
              <h3 class="box-title">Create Admin</h3>
            </div>
<!-- Form Name -->
  <form action="" method="POST" id="payment-form" class="form-horizontal">

      
    <div class="row box-body">
      <div class="col-md-12">
      
         <div class="alert alert-danger" id="a_x200" style="display: <?=$err?>;"> 
           <strong style="color:black">Error!</strong> 
           <span class="payment-errors" style="color:black"><?=$emailErr?></span>
          </div>
          <span class="payment-success"></span>                    
 
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Name<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="text" name="name"  value="<?=$name?>" placeholder="Ex: Username" class="lname form-control"  id="name" required >
      </div>
 </div> 
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">User Level<span class="req">*</span></label>
      <div class="col-sm-6">
        <select class="form-control" id="level" name="level" required>
            <option value="1">Administrator</option>
            <option value="3">Restricted User</option>
        </select>
      </div>
 </div> 

 <div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Email<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="email" name="email" value="<?=$emaildata?>" placeholder="Ex: Useremail" class="lname form-control"  id="email" value="" required >
      </div>
 </div> 
 <div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Password<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="password" name="password"  placeholder="Ex: Password" class="lname form-control"  id="password" value="" required >
      </div>
 </div> 

  
<div class="control-group">
      <div class="controls">
        <center>
        <?php
        
            echo '<button class="btn btn-success" type="submit" name="insert_admin">Add Admin</button>';
           
        ?>  
         </center>
<br>

      </div>
    </div>


<?php

if ($debug_page == true) {
    echo "<hr/>";
    echo "POST VALUES";
    var_dump($_POST);
    echo "<hr/>";
    echo "REQUEST VALUES";
    var_dump($_REQUEST);
}
?>


</form>

<?php
}else{
?>
<div class="box-header with-border">
  <h3 class="box-title"><?=$function?> Admin</h3>
            </div>
<!-- Form Name -->
<form action="" method="POST" id="payment-form" class="form-horizontal">      
    <div class="row box-body">
      <div class="col-md-12">      
         <div class="alert alert-danger" id="a_x200" style="display: <?=$err?>;"> 
            <strong style="color:black">Error!</strong> 
            <span class="payment-errors" style="color:black"> <?=$emailErr?></span>
          </div>
          <span class="payment-success"></span>
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Name<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="text" name="name"  placeholder="Ex: Username"  value="<?=$name?>" class="lname form-control"  id="name" required >
      </div>
 </div> 
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">User Level<span class="req">*</span></label>
      <div class="col-sm-6">
        <select class="form-control" id="level" name="level" required>
            <option value="1" <?php if ($level == '1'){ echo "selected"; } ?> >Administrator</option>
            <option value="3" <?php if ($level == '3'){ echo "selected"; } ?> >Restricted User</option>
        </select>
      </div>
 </div> 
 <div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Status<span class="req">*</span></label>
      <div class="col-sm-6">
        <select class="form-control" id="status" name="status" required>
            <option value="Active" <?php if ($level == 'Active'){ echo "selected"; } ?> >Active</option>
            <option value="Inactive" <?php if ($level == 'Inactive'){ echo "selected"; } ?> >Not Active</option>
        </select>
      </div>
 </div>
 <div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Email<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="hidden" name="oldemail"  placeholder="Ex: Useremail" class="lname form-control"  id="oldemail" value="<?=$emaildata?>" required >
        <input type="email" name="email"  placeholder="Ex: Useremail" class="lname form-control"  id="email" value="<?=$emaildata?>" required >
      </div>
 </div>  
  
<div class="control-group">
      <div class="controls">
        <center>
        <?php
        
            echo '<button class="btn btn-success" type="submit" name="update_admin">Update Admin</button>';
           
        ?>  
         </center>
<br>

      </div>
    </div>


<?php

if ($debug_page == true) {
    echo "<hr/>";
    echo "POST VALUES";
    var_dump($_POST);
    echo "<hr/>";
    echo "REQUEST VALUES";
    var_dump($_REQUEST);
}
?>


</form>
<?php } ?>
</div>

