<?php

require_once('config/config.php');

require_once 'include/phpmailer/class.phpmailer.php';
require_once 'include/phpmailer/class.smtp.php';

$run_date = date('Y-m-d H:i:s');
$sql = "INSERT INTO cron_run_log (cron_name, run_date) values ('CRON_EMAIL', '$run_date') ";
mysqli_query( $conn,$sql) or die("Insert cron log fail".mysqli_error($conn));


$now=date("Y-m-d H:i:s", time());
echo "<br/>Current Time = $now";
//$sql = "SELECT * FROM cron_emails where id=23";

$sql = "SELECT * FROM cron_emails where flag=0 and updated_time<='$now' LIMIT 0,20";

$result = mysqli_query($conn,$sql) or die("SQL Email Template Fetch error".mysqli_error($conn));
$email_list=array();
while($row=mysqli_fetch_array($result)){
    echo "<br/>Processing email to ".$row['to_email_id']; 
    $email_list[]=$row;
}
echo "<br/>SQL = ".$sql;

$admin_username="Seriousdating";
$admin_password="2dh9kVzDJHp7uojxFVefLg";
$host="smtp.mandrillapp.com"; 
$port=465;


foreach($email_list as $details) {
    $subject=$details['subject'];
    $msg=$details['msg'];
    $from_email_id=$details['from_email_id'];
    $from_name=$details['from_name'];
    $id=$details['id'];
    $to_email_id=$details['to_email_id']; //set default
    $cc_address = $details['cc_email'];
    $bcc_address = $details['bcc_email'];
    echo "<br/>Sending email to ".$to_email_id; 

    $date_now = date('Y-m-d H:i:s');
 
    $rt_msg = send_mail_with_smtp($to_email_id,$subject,$msg,$admin_username,$admin_password,$host,$port,$from_email_id,$from_name,$cc_address,$bcc_address);
    
    $sql_update = "update cron_emails set flag ='1', rt_msg = '$rt_msg', sent_date = '$date_now'  where id = '$id' ";
          
    mysqli_query($conn,$sql_update) or die("Update Cron email error".mysqli_error($conn));
}
echo "<br/>Processed all rows<hr/>";

function send_mail_with_smtp($new_email, $subject, $msg,$admin_username,$admin_password,$host,$port,$from_email_id,$from_name,$cc_address, $bcc_address) {

    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    try{
        $mail->SMTPDebug  = 1;                     
        $mail->SMTPAuth   = true;                  
        $mail->SMTPSecure = "ssl" ;
        $mail->From = $from_email_id;
        $mail->FromName = $from_name;
        $mail->Host       = $host;      
        $mail->Port       = $port;                  
        $mail->Username   = $admin_username; //user@domain.com
        $mail->Password   = $admin_password;           
        $mail->AddAddress($new_email);//RECIPIENT
        if ($cc_address != '') {
            $mail->AddCC($cc_address);
        }
        if ($bcc_address != '') {
            $mail->AddBCC($bcc_address);
        }
        $mail->AddBCC('seriousdating@hotmail.com');

        $mail->Subject = $subject;
        $mail->MsgHTML($msg);

        if(!$mail->Send()) {
            $rt_msg = 'Failure';
        }
        else {
            $rt_msg = 'Success';
        }
        
        echo "</br>Mail sent successfully";
        return $rt_msg;
    } catch (phpmailerException $e) {
        $rt_msg = $e->errorMessage(); 
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        echo $mail->Host;
        echo '<pre>';
        print_r($mail);
        echo '</pre>';
        return "Failure $rt_msg";

    } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        return "Failure";
    }
}

?>
