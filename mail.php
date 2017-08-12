<?php 



$imgDesc  = 'Serious Dating Logo'; // Change Alt tag/image Description to your site specific settings 
$imgTitle = 'Serious Dating Logo'; // Change Alt Title tag/image title to your site specific settings 


$subjectPara1 = 'Thank you for your subscription'; 
$subjectPara2 = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever  
since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,  
but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets  
containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'; 
$subjectPara3 = NULL; 
$subjectPara4 = NULL; 
$subjectPara5 = NULL; 

$message = '<!DOCTYPE HTML>'. 
'<head>'. 
'<meta http-equiv="content-type" content="text/html">'. 
'<title>Email notification</title>'. 
'</head>'. 
'<body>'. 
'<div id="header" style="width: 80%;height: 60px;margin: 0 auto;padding: 10px;color: #fff;text-align: center;background-color: green;font-family: Open Sans,Arial,sans-serif;color:white;">'. 
'<h1 style="color:#E89A2D;">Subscription</h1>'. 
'</div>'. 

'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
   '<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
       '<h3 style="color:#E89A2D;margin-left:50px;">'.$subjectPara1.'</h3>'. 
       '<p>'.$subjectPara2.'</p>'. 
       '<p>'.$subjectPara3.'</p>'. 
       '<p>'.$subjectPara4.'</p>'. 
       '<p>'.$subjectPara5.'</p>'. 
   '</div>'.   
'</div>'. 

'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;color:white;background-color: green;">'. 
   'All rights reserved @ Admin Team 2016'. 
'</div>'. 
'</body>'; 

/*EMAIL TEMPLATE ENDS*/ 


$to      = 'sakthissnite@gmail.com';             // give to email address 
$subject = 'Serious Dating';  //change subject of email 
$from    = '';                           // give from email address 

// mandatory headers for email message, change if you need something different in your setting. 
//$headers  = "From: " . $from . "\r\n"; 
//$headers .= "Reply-To: ". $from . "\r\n"; 
//$headers .= "CC: test@example.com\r\n"; 
$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 

// Remember, mail function may not work in PHP localhost setup but the email template can be used anywhere like (PHPmailer, swiftmailer, PHPMail classes etc.) 
// Sending mail 
mail('subrayan.s@outlook.com', $subject, $message, $headers);

?>