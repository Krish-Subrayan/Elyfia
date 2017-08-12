<?php
$menu_users="active";
  require_once('config/config.php');
  require_once('include/gen_functions.php');
  login();
  require_once('include/header.php');
  require_once('include/header_menu.php');

  $sql = "select * from admin_users order by id desc ";
  $result = mysqli_query($conn,$sql) or die("SQL User Fetch error".mysqli_error($conn));
  $user_data = array();
  $numofrows = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result)){
     $user_data[] = $row;
  }
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Admin users</li>
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
              <h3 class="box-title">Admin Users<a href="add_new_admin.php">
<button class="btn btn-success">Create New Admin</button>
</a></h3>
            </div>
<div class="box-body">

  
  <table class="table list_table table-striped table-bordered table2excel " cellspacing="0" width="100%" id="table_payment_list" >
    <thead>
      <tr>
	
	<th>Name</th>
	
	<th>Email</th>

	<th>Created Date</th>
        <th>Status</th>
        <th>Level</th>
	<th>Action</th>
      </tr>
    </thead>
      <tbody>
       <?php
         foreach($user_data as $details){
            if ($details['level'] == 1) {$level = 'Admin';} else { $level = 'Restricted'; }
           echo '<tr> 
             
             <td>'.$details['name'].'</td> 

             <td>'.$details['email'].'</td>
             <td>'.$details['created'].'</td>
             <td>'.$details['status'].'</td> 
            <td>'.$level.'</td>   

             <td>
              <a style="text-decoration:none;" href="add_new_admin.php?action=edit&id='.$details['id'].'"> 
                <button class="edit_webid"> Edit</button> 
              </a>  
              
              <a style="text-decoration:none;" href="add_new_admin.php?action=delete&deleteid='.$details['id'].'" onclick="return confirm(\'Are you sure you want to delete this item?\');"> 
                <button class="edit_webid" > Delete</button>
              </a>
              <a style="text-decoration:none;" href="change_admin_password.php?id='.$details['id'].'" > 
                <button class="edit_webid" > Change Password</button>
              </a>
             </td>
          </tr>';
        }
      ?>
     </tbody>
   </table>
 </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="name"></h4>
      </div>
      <div class="modal-body">
<input type="hidden" id="edit_id" />
          <div class="form-group">
            <label for="Status" class="control-label">Status</label>
            <select id="status" class="form-control">
            <option value="Active">Active</option>
            <option value="InActive">InActive</option>
            </select>
          </div>
          <div class="form-group">
            <label for="UserLevel" class="control-label">User Level</label>
            <select id="level" name="level" class="form-control">
            <option value="1">Administrator</option>
            <option value="3">Restricted User</option>
            </select>
          </div>

          <div class="form-group">
            <label for="password" class="control-label">Password:</label>
            <input type="password" class="form-control" id="password"></textarea>
            <p>*For old password,Leave it blank</p>
          </div>

      </div>
      <div class="modal-vooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_users" >Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
