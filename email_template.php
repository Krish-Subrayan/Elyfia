<?php
  require_once('config/config.php');
  require_once('include/gen_functions.php');
  login();
  require_once('include/header.php');
  require_once('include/header_menu.php');

  if(isset($_REQUEST['template_maker'])) { 
    $web_id    = $_REQUEST['select_webid'];
    $mail_type = $_REQUEST['mail_type'];
    $html      = $_POST['html_contents'];
    if ($web_id != '0' && $mail_type != '0') {
        $sql       = "select web_id from email_template where web_id = '$web_id' and mail_type = '$mail_type' " ;
        $query     = mysqli_query( $conn,$sql) or die(mysqli_error($conn));
        $exist     = mysqli_num_rows($query);
        $date      = date('Y-m-d h:i:s');
        if($exist == 0) {
          $sql = "insert into email_template(web_id,mail_type,message,created)values('$web_id','$mail_type','$html','$date')";
          $query     = mysqli_query( $conn,$sql) or die(mysqli_error($conn));
          if($query)   $_SESSION['status'] = ' Template Created Successfully </p></center>';
          else $_SESSION['status'] = ' Something went wrong. </p></center>';
        }
        else { 
          $sql = "update email_template set web_id ='$web_id',mail_type = '$mail_type',message ='$html',created = '$date' where web_id = '$web_id' and mail_type = '$mail_type' ";
          $query     = mysqli_query($conn,$sql) or die(mysqli_error($conn));
          if($query)   $_SESSION['status'] = ' Template Updated Successfully </p></center>';
          else $_SESSION['status'] = ' Something went wrong. </p></center>';
         }
    }
  }
 
  $query = mysqli_query($conn,"SELECT * FROM webid");
  $value1=array();
  $numofrows=mysqli_num_rows($query);
  while($row=mysqli_fetch_array($query)){
     $value1[]=$row;
  }
?>

    <form action="" method="POST" id="form_submit" enctype="multipart/form-data">
       <center> Web Id : 
           <select  id="select_webid" name="select_webid" >
               
               <option value="0" >Select...</option>
               <option value="Default" >Default</option>
                <?php
                
                  foreach($value1 as $details){
                    echo '<option '. $checked. ' value='.$details['web_id'].'>'.$details['web_id'].'</option>';
                  }
               ?>
          </select>
       </center>
    <br><br>
        <center> Email Type : 
           <select  name="mail_type" id="mail_type" >
               <option value="0">Select...</option>
              <option>Subscription Mail</option>
              <option>User Details Mail</option>
              <option>User Block Mail</option>
              <option>User Unblock Mail</option>
              <option>User Unsubscribe Mail</option>
           </select>
         </center>
    <br><br>       
 <div id="sample">
       <center> Email Content :<br/>
           <textarea id="html_contents" name="html_contents" > </textarea><br/>
                  <center>
                   <input class="btn btn-primary" type="submit" name="template_maker" value="Submit"> 
                  </center>
        </center>
     </form>
       <script>
           $(document).ready(function() {
               CKEDITOR.replace( 'html_contents',{height: 200,witth: 700});
               
            
        $("#mail_type").change(function() {
               var mail_type = $(this).val();
               var web_id    = $("#select_webid").val();
               var data      = {mail_type:mail_type,webid:web_id}
               if (web_id != '0' && mail_type != '0') {
               $.ajax({
                 url    :'get_email_contents.php',
                 method :'post',
                 data   : data,  
                 success:function(data) {
                    var obj = $.parseJSON(data);
                   CKEDITOR.instances['html_contents'].setData(obj.message);
               }
              });
              }
            });
           $("#select_webid").change(function() {
               var mail_type = $("#mail_type").val();
               var web_id    = $(this).val();
               var data      = {mail_type:mail_type,webid:web_id}
        if (web_id != '0' && mail_type != '0') {       
                 $.ajax({
                 url    :'get_email_contents.php',
                 method :'post',
                 data   : data,  
                 success:function(data) {
                    var obj = $.parseJSON(data);
                    CKEDITOR.instances['html_contents'].setData(obj.message);
                  }
              });
          }
            });
          });
     </script> 
    </body>
</html>



