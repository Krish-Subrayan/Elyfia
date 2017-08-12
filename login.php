<?php
require_once('config/config.php');
require_once('include/gen_functions.php');
require_once('include/header.php');

if(isset($_POST['login'])) {
  extract($_POST); 
  $user = sanit_data($user);
  $pass = md5(sanit_data($pass));
  $sql = "select * from admin_users  where email = '$user' and password = '$pass' ";
  $exec_sql = mysqli_query($conn,$sql) or die(mysqli_error($conn));
  if(mysqli_num_rows($exec_sql) == 1) {
    $row = mysqli_fetch_array($exec_sql) or die(mysqli_error($conn));
    if($user == $row['email'] && $pass == $row['password']) {
      $_SESSION['admin'] = $row['name']; 
      $_SESSION['admin_id']=$row['id']; 
      $_SESSION['admin_id_level']=$row['level']; 
      $_SESSION['main_access_token']=$row['access_token'];

      if ($row['level'] == 1) {
        header('location: dashboard.php');
        exit;
      }
      if ( $row['level'] == 3) {
        header('location: list_user_address.php');
        exit;
      }
      header('location: dashboard.php');
      exit;
    } else {
      $error = '<p style="color:red"> Wrong User Name/Password</p>';
    }
  }  else {
    $error = '<p style="color:red"> Wrong User Name/Password</p>';
  }
}
?>
<body class="hold-transition login-page" style=" background: url('img/black2.jpg') no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; background-size: cover; ">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
  <h4>  <p class="login-box-msg"><?php echo $gbl_site_name; ?> - Admin Login</p></h4>
<?php 
					      if(isset($error)){
							       echo '<center>'.$error.'</center>';
					      }
					?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" id="inputEmail"  name="user" required="">

      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="inputPassword"  name="pass" required="">

      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
           
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name='login'>Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->

    
  </div>
  <!-- /.login-box-body -->
</div>

<script>
$(document).ready(function(){
$("#inputEmail").focus();
});
</script>
</body>
</html>

