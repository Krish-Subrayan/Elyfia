<?php
$patients="active";
require_once('config/config.php');
require_once('include/gen_functions.php');
login();
require_once('include/header.php');
require_once('include/header_menu.php');

$debug_page=false;
$page_title = "Create New Patient";
//intialize the values
$action="add";
$field_disabled ='';
$field_all_disabled='';
$id='';
$uid='';
$access_token='';
$gethealthid='';
$status='';

if(isset($_REQUEST['action'])) {
    if ( ($_REQUEST['action'] == 'edit') || ($_REQUEST['action'] == 'delete') ){
        $action='edit';
        $page_title = "Edit Patient";
        
        $field_disabled ='disabled';

        $id = sanit_data($_REQUEST['id']);
        $sql = "select * from patients where id = '".$id."' LIMIT 0,1 ";
        $result = mysqli_query($conn, $sql) or die ("Error while fetching patient info".mysqli_error($conn));
        $row=mysqli_fetch_array($result);
        $uid = $row['uid'];
        $access_token = $row['access_token'];
	      $gethealthid=$row['gethealthid'];
        $status = $row['status'];        
    }
    if ($_REQUEST['action'] == 'delete') {
        $action='delete';
        $page_title = "Delete Patient";
        $field_all_disabled =' disabled ';

    }
    
}

if(isset($_REQUEST['edit_patient'])) { 
  extract($_REQUEST); 
  $uid = sanit_data($uid);

  $sql = "UPDATE patients SET uid = '".$uid."', status = '".$status."' WHERE id = '".$id."' ";

  if ($debug_page == true) {
      echo $sql;
  }

  $result = mysqli_query($conn,$sql)or die('Update Patient Error'.mysqli_error($conn));
          
  $_SESSION['status'] = 'Patient Record was updated successfully !!';

  header('Location: list_patients.php'); 
  exit;    

} // edit_patient end


if(isset($_REQUEST['delete_patient'])) { 
  extract($_REQUEST); 

  $sql = "DELETE FROM patients WHERE id = '".$id."' ";

  $result = mysqli_query($conn,$sql)or die('Delete Patient Error'.mysqli_error($conn));

  $_SESSION['status'] = 'Patient was deleted successfully !! ';
  header('Location: list_patients.php'); 
  exit;  
} // delete patient end

if(isset($_REQUEST['cancel'])) { 
    header('Location: list_patients.php'); 
    exit;
}

if(isset($_REQUEST['insert_patient'])) { 
  extract($_REQUEST); 
  if ($debug_page == true) { var_dump($_POST); };

  $uid = sanit_data($uid);

  $_SESSION['status'] = 'Patient  ('.$uid.') was created successfully !!';

  header('Location: list_plans.php'); 
  exit;    
} // $_REQUEST(insert)

     
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Patient
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Patients</a></li>
        <li class="active">Create Patient</li>
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
      <input type="hidden" name="display_text" id="display_text" value="<?php echo $display_text; ?>" >
      <input type="hidden" name="uid_info" id="uid_info" value="<?php echo $uid; ?>" >
    <div class="row box-body">
      <div class="col-md-12">
      <?php
if( isset($_SESSION['status'])){
    echo '<center><div style="width:50%;" class="callout callout-info">'.$_SESSION['status'].'</div></center>';
    unset($_SESSION['status']);
}


?>
         <div class="alert alert-danger" id="a_x200" style="display: none;"> 
           <strong>Error!</strong> 
           <span class="payment-errors"></span>
          </div>
          <span class="payment-success"></span>
          <fieldset>
          <?php if(($_REQUEST['action'] == 'edit') || ($_REQUEST['action'] == 'delete')){ ?>
<div class="form-group">
  <label class="col-sm-4 control-label"  for="textinput">Patient Id  <span class="req">*</span></label>
     <div class="col-sm-6">
       <input type="text" name="uid"  <?php echo $field_all_disabled; ?> placeholder="Ex: Patient Name" class="fname form-control" id="uid" required value="<?php echo $uid; ?>">
     </div>
</div>
	<?php } ?>
 
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">Access Token<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="text" name="access_token" <?php echo $field_all_disabled; ?> placeholder="Ex: Silver" class="lname form-control"  id="access_token" required value="<?php echo $access_token; ?>" >
      </div>
 </div> 
<div class="form-group">
   <label class="col-sm-4 control-label" for="textinput">GetHealth Id<span class="req">*</span></label>
      <div class="col-sm-6">
        <input type="text" name="gethealthid" <?php echo $field_all_disabled; ?> placeholder="Ex: Silver" class="lname form-control"  id="gethealthid" required value="<?php echo $gethealthid; ?>" >
      </div>
 </div> 

  </fieldset>

<div class="control-group">
      <div class="controls">
        <center>
        <?php
        if ($action == 'delete') {
            echo '<h2>This action cannot be undone and it will delete Patients from GetHealth API also!! Are you Sure?</h2>';
        }
        
           echo '<button class="btn btn-success" type="submit" formnovalidate name="cancel">Cancel</button> &nbsp;&nbsp;';
          if($action == 'add')  
            echo '<button class="btn btn-success" type="submit" name="insert_patient">Add Patient</button>';
           else if ($action == 'edit')
            echo '<button class="btn btn-success" type="submit" name="edit_patient">Save Patient</button>';
           else if ($action == 'delete') 
            echo '<button class="btn btn-success" type="submit" name="delete_patient">Delete Patient</button>';
               
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

