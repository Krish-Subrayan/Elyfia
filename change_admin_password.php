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

if(isset($_POST['password'])) {       
  
  $sql = "UPDATE admin_users 
               SET 
               password = '".MD5($password)."'               
              WHERE 
                id ='".$_POST['user_id']."'
                ";
  echo $sql;
  $query = mysqli_query( $conn,$sql) or die("Insert admin Error".mysqli_error($conn)); 

  $_SESSION['status'] = "Admin password updated successfully";

  header('Location: Administrators.php'); 
  exit;
} // $_REQUEST(insert)
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         User Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
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
<!-- Form Name -->
<form action="change_admin_password.php" method="POST" id="passwordadmin-form" class="form-horizontal">
 <div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">New Password<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="hidden" name="user_id" value="<?=$_GET['id']?>" >
        <input type="password" name="password"  placeholder="Ex: Password" class="lname form-control"  id="password" value="" required >
      </div>
 </div> 
 <div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Re-type Password<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="password" name="repassword" pattern=".{0}|.{6,}"   required title="Either 0 OR (8 chars minimum)" placeholder="Ex: Password" class="lname form-control"  id="repassword" value="" required >
      </div>
 </div> 
  
<div class="control-group">
      <div class="controls">
        <center>
        <?php        
            echo '<button class="btn btn-success" type="button" onclick="checkPassword();" name="update_password">Update Password</button>';          
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
</div>
<script>
function checkPassword(){
  var password = $('#password').val();
  var repassword = $('#repassword').val();
  
  if (password.length<6){
    alert("Password must not be less than 6 characters");
    return false;
  }

  if (password!=repassword){
    alert("Password not matched");
    return false;
  }

  $('#passwordadmin-form').submit();

}
</script>