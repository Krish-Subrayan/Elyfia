<?php
$configurtaion="active";
require_once('config/config.php');
require_once('include/gen_functions.php');
login();
require_once('include/header.php');
require_once('include/header_menu.php');
  
$debug_page=false;
$page_title = "Default template";

$gbl_email_type_array = array(
                              "WelcomeEmail" => "Welcome Email",
                              "ReWelcomeEmail" => "Remainder Welcome Email",
                              "ReceiptofPayment"=>"Receipt of Payment",
                              "TerminationMail"=>"Termination Mail"
                          );


if(isset($_REQUEST['insert_template'])) { 

    extract($_REQUEST);
    $array=array();
            $current_date      = date('Y-m-d h:i:s');
    $created_date = $current_date;
        $modified_date = $current_date;
        $created_by = $_SESSION['admin'];
        $modified_by = $_SESSION['admin'];
	foreach($mail_type as $default){
	 $sql       = "select * from email_template where web_id = 'Default' and mail_type = '$default' " ; 

        $query     = mysqli_query( $conn,$sql) or die(mysqli_error($conn));
        $array=mysqli_fetch_array($query);
        $current_date      = date('Y-m-d h:i:s');
        
        if(!empty($array['mail_type'])){
        	 $sql_check_webid       = "select id from email_template where web_id = '$webid' and mail_type = '$default' " ; 
		$query_check_webid    = mysqli_query( $conn,$sql_check_webid) or die(mysqli_error($conn));
		        $exist     = mysqli_num_rows($query_check_webid);
		        if($exist>0){
		        $sql_update = "update email_template set 
                  remarks ='".$array['remarks']."',  
                  message ='".$array['message']."', 
                  subject='".$array['subject']."',
                  from_email_id='".$array['from_email_id']."', 
                  from_email_name='".$array['from_name']."', 
                  email_to_users='".$array['email_to_users']."', 
                  email_to_admin='".$array['email_to_admin']."', 
                  admin_email='".$array['admin_email']."', 
                  email_delay='".$array['email_delay']."',
                  modified_by ='".$modified_by."', 
                  modified_date ='".$modified_date."' 
                  where web_id = '".$webid."' and mail_type = '".$default."' ";
          echo $sql_update."<hr/>";
          $query_update     = mysqli_query($conn,$sql_update) or die("Update Email template error".mysqli_error($conn));
		        
		        
		        }
		        else{
        $sql = "insert into email_template 
                  (web_id, mail_type,subject, remarks, message,from_email_id,from_email_name,email_to_users,email_to_admin,admin_email,email_delay, created_by, created_date, modified_by, modified_date )
                  values(
                  '".$webid."', 
                  '".$array['mail_type']."', 
                  '".$array['subject']."', 
                  '".$array['remarks']."', 
                  '".$array['message']."', 
                  '".$array['from_email_id']."', 
                  '".$array['from_name']."', 
                  '".$array['email_to_users']."', 
                  '".$array['email_to_admin']."', 
                  '".$array['admin_email']."', 
                  '".$array['email_delay']."',
                  '".$created_by."', 
                  '".$created_date."', 
                  '".$modified_by."', 
                  '".$modified_date."' )";
          echo $sql."<hr/>";
          $query     = mysqli_query( $conn,$sql) or die("Insert Email template Error".mysqli_error($conn));
          }
}
        

        }
                  $_SESSION['status'] = ' Default Email Template for ('.$webid.')  Created Successfully </p></center>';
        header('Location: default_email_templates.php'); 
        exit;

}
$sql = "SELECT web_id FROM webid ";
$result = mysqli_query($conn,$sql) or die("Error in WebId Select".mysqli_error($conn));
$webid_arr=array();
while($row=mysqli_fetch_array($result)){
   $webid_arr[]=$row;
}


?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Default Email Templates
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Configuration</a></li>
        <li class="active">Default Email templates</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<div class="row ">

<div class="col-md-12">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $page_title; ?></h3>
            </div>
<!-- Form Name -->
  <form action="" method="POST" id="payment-form" class="form-horizontal">
      
    <div class="row box-body">
      <div class="col-md-12">
      <?php
if( isset($_SESSION['status'])){
    echo '<center><div style="width:50%;" class="callout callout-info">'.$_SESSION['status'].'</div></center>';
    unset($_SESSION['status']);
}


?>
          <fieldset>
<div class="form-group">
  <label class="col-sm-4 control-label"  for="textinput">Web Id  <span class="req">*</span></label>
     <div class="col-sm-6">
        <select  id="webid" name="webid" <?php echo $field_disabled; ?> required>
        <option value="0" >Select...</option>
        <?php
        
        foreach($webid_arr as $details){
            $selected = '';
            if ($webid == $details['web_id']) { $selected = 'selected = "selected"'; }
            echo '<option '. $selected. ' value='.$details['web_id'].'>'.$details['web_id'].'</option>';
        }
        ?>
        </select>
     </div>
</div>
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Mail Type<span class="req">*</span></label>
      <div class="col-sm-6">
 <select class="select2" id="mail_type" name="mail_type[]" style="height: 100px;width:300px;" multiple="multiple" required>
    <optgroup label="Select multiple">
       <?php
                  foreach($gbl_email_type_array as $key => $values){
                    
                    echo '<option '. $selected. ' value='.$key.'>'.$values.'</option>';
                  }
               ?>
    </optgroup>
    </select>
    </div>
    </div>
<!--<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Mail Type<span class="req">*</span></label>
      <div class="col-sm-6">
           <select  name="mail_type" id="mail_type" <?php echo $field_disabled; ?> >
               <option value="0">Select...</option>
                <?php
                  foreach($gbl_email_type_array as $key => $values){
                    $selected = '';
                    if ($mail_type == $key) { $selected = 'selected = "selected"'; }
                    echo '<option '. $selected. ' value='.$key.'>'.$values.'</option>';
                  }
               ?>
           </select>
      </div>
 </div> -->
  
<div class="control-group">
      <div class="controls">
        <center>
        <?php
        
            echo '<button class="btn btn-success" type="submit" name="insert_template">Add Templates</button>';
           
        ?>  
         </center>
<br>

      </div>
    </div>

</fieldset>
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
<script>
$("#mail_type").multiselect({
    
  });
</script>
</body>
</html>



