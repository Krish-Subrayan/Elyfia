<?php 
   
   
   require_once('config/config.php');        
   $id = $_REQUEST['id'];
      $edit_id = $_REQUEST['edit_id'];
   $status = $_REQUEST['status'];
   $password= $_REQUEST['password'];
   $type=$_REQUEST['type'];

   if($type=='delete'){
    $sql = "delete FROM users WHERE id = '$edit_id' ";
       $query =  mysqli_query($conn,$sql) or die(mysqli_error($conn));
      // $sql = "delete FROM stripe_trial_tranactions WHERE stripe_id = '$id' ";
       //$query =  mysqli_query($conn,$sql) or die(mysqli_error($conn));
       if($query) 
         echo 'Successfully Deleted';
   }
   else{
	  if(!empty($password)){
		  
	     $sql = "update users set status = '".$status."',password='".$password."' WHERE id = '".$id."' ";
	     $query =  mysqli_query($conn,$sql) or die(mysqli_error($conn));
	    // $sql = "update stripe_trial_tranactions set user_block = $block WHERE stripe_id = '$id' ";
	    // $query =  mysqli_query($conn,$sql) or die(mysqli_error($conn));
	  }
	 else{

	     $sql = "update users set status = '".$status."' WHERE id = '".$id."' ";
	     $query =  mysqli_query($conn,$sql) or die(mysqli_error($conn));

		}
		if($query) echo 'Successfully Updated';

	    
    
    }
      
   
?>


