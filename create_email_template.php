<?php
$configurtaion="active";
require_once('config/config.php');
require_once('include/gen_functions.php');
login();
require_once('include/header.php');
require_once('include/header_menu.php');
  
$debug_page=false;
$page_title = "Create New Template";
//intialize the values
$action="add";
$field_disabled ='';
$field_all_disabled='';
$id='';

$webid='';
$mail_type='';
$subject='';
$message='';
$remarks='';
$from_email_id='';
$from_name='';
$email_to_users='';
$email_to_admin='';
$admin_email ='';
$email_delay='';
$gbl_email_type_array = array("PlanCreation" => "Plan Creation" ,
                              "PlanUpdate" => "Plan Update",
                              "PlanDelete" => "Plan Delete",
                              "WebIDCreation" => "WebId Creation",
                              "WebIDUpdate" => "WebId Update",
                              "WebIDDelete" => "WebId Delete",
                              "PlanSubscription" => "Plan Subscription",
                              "Cancel Subscription" => "Cancel Subscription",
                              "TrialPayAmount" => "Trial Pay Amount",
                              "RefundAmount" => "Refund Amount",
                              "UserAddition" => "User Additon",
                              "UserBlock" => "User Block",
                              "UserUnblock" => "User Unblock",
                              "WelcomeEmail" => "Welcome Email",
                              "ReWelcomeEmail" => "Remainder Welcome Email",
                              "ReceiptofPayment"=>"Receipt of Payment",
                              "TerminationMail"=>"Termination Mail"
                          );

if(isset($_REQUEST['action'])) {
    if ( ($_REQUEST['action'] == 'edit') || ($_REQUEST['action'] == 'delete') ){
        $action='edit';
        $page_title = "Edit Email Template";
        $field_disabled ='disabled';

        $id = sanit_data($_REQUEST['id']);
        $sql = "select * from email_template where id = '".$id."' LIMIT 0,1 ";
        $result = mysqli_query($conn, $sql) or die ("Error while fetching email template info".mysqli_error($conn));
        $row=mysqli_fetch_array($result);
        $webid = $row['web_id'];
        $mail_type = $row['mail_type'];
        $remarks = $row['remarks'];
	$subject = $row['subject'];
        $message = $row['message'];
        $from_email_id= $row['from_email_id'];
        $from_name= $row['from_email_name'];
        $email_delay=$row['email_delay'];
       if($row['email_to_users']=="Yes"){
          $checked_users_yes="checked";
       }
       else{
       
           $checked_users_no="checked";      
       }
        if($row['email_to_admin']=="Yes"){
          $checked_admin_yes="checked";
       }
       else{
       
           $checked_admin_no="checked";      
       }
        $admin_email= $row['admin_email'];
    }
    if ($_REQUEST['action'] == 'delete') {
        $action='delete';
        $page_title = "Delete Email Template";
        $field_all_disabled =' disabled ';
     }
} // edit or delete end


if(isset($_REQUEST['insert_template'])) { 
    extract($_REQUEST);

    if ($webid != '0' && $mail_type != '0') {

        $sql       = "select id from email_template where web_id = '$webid' and mail_type = '$mail_type' " ;
        echo $sql."<hr/>";
            
        $query     = mysqli_query( $conn,$sql) or die(mysqli_error($conn));
        $exist     = mysqli_num_rows($query);
        $current_date      = date('Y-m-d h:i:s');
        $created_date = $current_date;
        $modified_date = $current_date;
        $created_by = $_SESSION['admin'];
        $modified_by = $_SESSION['admin'];
        if($exist == 0) {
          $sql = "insert into email_template 
                  (web_id, mail_type,subject, remarks, message,from_email_id,from_email_name,email_to_users,email_to_admin,admin_email,email_delay, created_by, created_date, modified_by, modified_date )
                  values(
                  '".$webid."', 
                  '".$mail_type."', 
                  '".$subject."', 
                  '".$remarks."', 
                  '".$message."', 
                  '".$from_email_id."', 
                  '".$from_name."', 
                  '".$email_to_users."', 
                  '".$email_to_admin."', 
                  '".$admin_email."', 
                  '".$email_delay."',
                  '".$created_by."', 
                  '".$created_date."', 
                  '".$modified_by."', 
                  '".$modified_date."' )";
          echo $sql."<hr/>";
          $query     = mysqli_query( $conn,$sql) or die("Insert Email template Error".mysqli_error($conn));
          $_SESSION['status'] = ' Email Template ('.$mail_type.') for ('.$webid.')  Created Successfully </p></center>';
        header('Location: list_email_templates.php'); 
        exit;
          
          
        }
        else { 
          $sql = "update email_template set 
                  remarks ='".$remarks."',  
                  message ='".$message."', 
                  subject='".$subject."',
                  from_email_id='".$from_email_id."', 
                  from_email_name='".$from_name."', 
                  email_to_users='".$email_to_users."', 
                  email_to_admin='".$email_to_admin."', 
                  admin_email='".$admin_email."', 
                  email_delay='".$email_delay."',
                  modified_by ='".$modified_by."', 
                  modified_date ='".$modified_date."' 
                  where web_id = '".$webid."' and mail_type = '".$mail_type."' ";
          echo $sql."<hr/>";
          $query     = mysqli_query($conn,$sql) or die("Update Email template error".mysqli_error($conn));
          $_SESSION['status'] = ' Email Template ('.$mail_type.') for ('.$webid.')  Updated Successfully </p></center>';
        header('Location: list_email_templates.php'); 
        exit;
         }
    }
}// insert template end


if(isset($_REQUEST['edit_template'])) { 
    extract($_REQUEST); 

    $sql = "select * from email_template where id = '$id' " ;
    $result  = mysqli_query( $conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $webid = $row['web_id'];
    $mail_type = $row['mail_type'];
    
    $current_date      = date('Y-m-d h:i:s');
    $modified_date = $current_date;
    $modified_by = $_SESSION['admin'];

   $sql = "update email_template set 
                  remarks ='".$remarks."',  
                  message ='".$message."', 
                  subject='".$subject."',
                  from_email_id='".$from_email_id."', 
                  from_email_name='".$from_name."', 
                  email_to_users='".$email_to_users."', 
                  email_to_admin='".$email_to_admin."', 
                  admin_email='".$admin_email."', 
                  email_delay='".$email_delay."',
                  modified_by ='".$modified_by."', 
                  modified_date ='".$modified_date."' 
                  where web_id = '".$webid."' and mail_type = '".$mail_type."' ";
                  echo $sql;
      $query     = mysqli_query($conn,$sql) or die("Update Email template error".mysqli_error($conn));
      
    $_SESSION['status'] = 'Email Template  ('.$mail_type.') for ('.$webid.')   was Updated successfully !!';
    header('Location: list_email_templates.php'); 
    exit;
} // edit template end
if(isset($_REQUEST['send_test_mail'])) { 
    extract($_REQUEST); 

    $sql = "select * from email_template where id = '$id' " ;
    $result  = mysqli_query( $conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $webid = $row['web_id'];
    $mail_type = $row['mail_type'];
    
    $current_date      = date('Y-m-d h:i:s');
    $modified_date = $current_date;
    $modified_by = $_SESSION['admin'];

  $sql_insert = "insert into cron_emails 
                  (subject,msg,from_email_id,from_name,to_email_id,email_delay,updated_time,flag )
                  values(
                  '".$subject."', 
                  '".$message."', 
                  '".$from_email_id."', 
                  '".$from_name."', 
                  '".$admin_email."', 
                  '".$email_delay."', 
                  '".$current_date."',
                  '0' )";
          //echo $sql."<hr/>";
          $query     = mysqli_query( $conn,$sql_insert) or die("Insert Email template Error".mysqli_error($conn));

      
    $_SESSION['status'] = 'Mail Sent to '.$admin_email.' !!';
    header('Location: list_email_templates.php'); 
    exit;
} // edit template end
  
if(isset($_REQUEST['delete_template'])) { 
     extract($_REQUEST); 
     var_dump($_POST);
    
    $sql = "DELETE FROM email_template 
     WHERE id = '".$id."' ";

    if ($debug_page == true) {
        echo $sql;
    }

    $result = mysqli_query($conn,$sql)or die('Delete Plan Error'.mysqli_error($conn));

    $_SESSION['status'] = 'Email Template  ('.$id.') was deleted successfully !!';
    header('Location: list_email_templates.php'); 
    exit;

} // delete template end

 
if(isset($_REQUEST['cancel'])) { 
    header('Location: list_email_templates.php'); 
    exit;
}

$sql = "SELECT web_id FROM webid ";
$result = mysqli_query($conn,$sql) or die("Error in WebId Select".mysqli_error($conn));
$webid_arr=array();
while($row=mysqli_fetch_array($result)){
   $webid_arr[]=$row;
}



?>
<style>
.form-horizontal .form-group {
    margin-left: -117px !important;
    margin-right: -15px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Email Templates
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Configuration</a></li>
        <li class="active">Create Email templates</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">

<div class="col-md-12">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $page_title; ?></h3>
            </div>
<!-- Form Name -->
  <form action="" method="POST" id="payment-form" class="form-horizontal">
      <input type="hidden" name="id" id="id" value ="<?php echo $id; ?>" >
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
        <select  id="webid" name="webid" <?php echo $field_disabled; ?> >
        <option value="0" >Select...</option>
        <?php
        if ($webid == 'Default') { 
            echo '<option value="Default" selected="selected" >Default</option>'; 
        }
        else {
            echo '<option value="Default" >Default</option>'; 
        }
        foreach($webid_arr as $details){
            $selected = '';
            if ($webid == $details['web_id'] || $_GET['web_id']==$details['web_id']) { $selected = 'selected = "selected"'; }
            echo '<option '. $selected. ' value='.$details['web_id'].' >'.$details['web_id'].'</option>';
        }
        ?>
        </select>&nbsp;&nbsp;<a href="default_email_templates.php">Click here set default templates</a>
     </div>
</div>
 
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Mail Type<span class="req">*</span></label>
      <div class="col-sm-6">
           <select  name="mail_type" id="mail_type" <?php echo $field_disabled; ?> >
               <option value="0">Select...</option>
                <?php
                  foreach($gbl_email_type_array as $key => $values){
                    $selected = '';
                    if ($mail_type == $key) { $selected = 'selected = "selected"'; }
                    echo '<option '. $selected. ' value='.$key.' id="'.$key.'" >'.$values.'</option>';
                  }
               ?>
           </select>
      </div>
 </div> 
   <div class="form-group">
  <label class="col-sm-4 control-label"  for="textinput">Subject  <span class="req">*</span></label>
     <div class="col-sm-6">
       <input type="text" name="subject"  placeholder="Subject" class="fname form-control" id="subject" required value="<?php echo $subject; ?>">
     </div>
</div>   
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Email Content<span class="req">*</span></label>
<div class="col-sm-6" > 
           <textarea  id="message" name="message" <?php echo $field_all_disabled; ?> ><?php echo $message; ?></textarea><br/>
  </div>
</div>         
 <div class="form-group">
  <label class="col-sm-4 control-label"  for="textinput">Remarks  <span class="req">*</span></label>
     <div class="col-sm-6">
       <input type="text" name="remarks"  <?php echo $field_all_disabled; ?> placeholder="Sample Remarks" class="fname form-control" id="remarks" required value="<?php echo $remarks; ?>">
     </div>
</div>    
 <div class="form-group">
  <label class="col-sm-4 control-label"  for="textinput">From Email id  <span class="req">*</span></label>
     <div class="col-sm-6">
       <input type="email" name="from_email_id"  placeholder="From Email id" class="fname form-control" id="from_email_id" required value="<?php echo $from_email_id; ?>">
     </div>
</div>   
 <div class="form-group">
  <label class="col-sm-4 control-label"  for="textinput">From Name  <span class="req">*</span></label>
     <div class="col-sm-6">
       <input type="text" name="from_name"  placeholder="From name" class="fname form-control" id="from_name" required value="<?php echo $from_name; ?>">
     </div>
</div>            
<div class="form-group ">
  	<label class="col-sm-4 control-label">Email to Admin</label>
	<div style="width:10%" class="col-sm-2">
		<input type="radio" value="Yes" <?php echo $checked_admin_yes;?> name="email_to_admin" ><span> Yes</span>
	</div>
	<div class="col-sm-2">
		<input type="radio" <?php echo $checked_admin_no;?> value="No" name="email_to_admin" ><span> No</span>
	</div>
</div>
  <div class="form-group" id="admin_email_form">
  <label class="col-sm-4 control-label"  for="textinput">Admin email  <span class="req">*</span></label>
     <div class="col-sm-6">
       <input type="email" name="admin_email"  placeholder="Admin Email" class="fname form-control" id="admin_email"  value="<?php echo $admin_email; ?>">
     </div>
</div>
<div class="form-group ">
  	<label class="col-sm-4 control-label">Email to users</label>
	<div style="width:10%" class="col-sm-2">
		<input type="radio" value="Yes" <?php echo $checked_users_yes;?> name="email_to_users" ><span> Yes</span>
	</div>
	<div class="col-sm-2">
		<input type="radio"  value="No" name="email_to_users" <?php echo $checked_users_no;?> ><span> No</span>
	</div>
</div> 
<div class="form-group">
  <label class="col-sm-4 control-label"  for="textinput">Email delay(min)  <span class="req"></span></label>
     <div class="col-sm-6">
       <input type="text" name="email_delay"  placeholder="Email Delay(Min)" class="fname form-control" id="email_delay" required value="<?php echo $email_delay; ?>">
     </div>
</div>    
</div>
  </div>
</fieldset>

<div class="control-group">
      <div class="controls">
        <center>
        <?php
        if ($action == 'delete') {
            echo '<h2>This action cannot be undone and it will delete content from database!! Are you Sure?</h2>';
        }
        
           echo '<button class="btn btn-success" type="submit" formnovalidate name="cancel">Cancel</button> &nbsp;&nbsp;';
          if($action == 'add')  {
            echo '<button class="btn btn-success" type="submit" name="insert_template">Add Template</button>';
	}
           else if ($action == 'edit'){
            echo '<button class="btn btn-success" type="submit" name="edit_template">Save Template</button> &nbsp;&nbsp;';
            echo '<button class="btn btn-warning" type="submit" name="send_test_mail">Send Test mail</button>';
	}
           else if ($action == 'delete') {
            echo '<button class="btn btn-success" type="submit" name="delete_template">Delete Template</button>';
	}
               
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
$(document).ready(function() {

		if($('input[name=email_to_admin]:checked').val()=="No"){

		$('#admin_email_form').hide();
		}
		else{

		$('#admin_email_form').show();
		}
	$('input[name=email_to_admin]').click(function() {
		if($('input[name=email_to_admin]:checked').val()=="No"){

		$('#admin_email_form').hide();
		}
		else{

		$('#admin_email_form').show();
		}
	});


    //CKEDITOR.replace( 'message',{height: 200,width: 700});
      var editor = new Jodit('#message', {
   		height: 700, 
	});        
    $("#webid").change(function() {
        var mail_type = $("#mail_type").val();
        var webid    = $(this).val();
        if(webid!="Default"){
        $("#PlanCreation,#PlanUpdate,#PlanDelete,#WebIDCreation,#WebIDUpdate,#WebIDDelete").hide();
        
        }
        if(webid=="Default"){
        $("#PlanCreation,#PlanUpdate,#PlanDelete,#WebIDCreation,#WebIDUpdate,#WebIDDelete").show();
        
        }
        
        var data      = {mail_type:mail_type,webid:webid}
         if (webid != '0' && mail_type != '0') {       
                  $.ajax({
                  url    :'get_email_contents.php',
                  method :'post',
                  data   : data,  
                  success:function(data) {
                     var obj = $.parseJSON(data);
                     $("#remarks").val(obj.remarks);
                     //CKEDITOR.instances['message'].setData(obj.message);
			jodit.modules.Dom(obj.message);
                   }
               });
           }
     });
            
    $("#mail_type").change(function() {
           var mail_type = $(this).val();
           var webid    = $("#webid").val();
           var data      = {mail_type:mail_type,webid:webid}
           if (webid != '0' && mail_type != '0') {
                $.ajax({
                  url    :'get_email_contents.php',
                  method :'post',
                  data   : data,  
                  success:function(data) {
                     var obj = $.parseJSON(data);
                     $("#remarks").val(obj.remarks);
                    //CKEDITOR.instances['message'].setData(obj.message);
			jodit.modules.Dom(obj.message);
                }
              });
          }
        });
});
</script> 
</body>
</html>



