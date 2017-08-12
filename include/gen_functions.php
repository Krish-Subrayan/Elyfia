<?php
 
 function login() {
  if(!isset($_SESSION['admin']) || $_SESSION['admin'] === NULL) {
     header('location: login.php') ;
     exit;      
  }
 }
 
 function sanit_data($data) {
   return(addslashes(htmlentities(htmlspecialchars($data))));
 }

 function menu_is_active_by_file($filename) {	
	if(is_array($filename)) {
		$good = FALSE;
		foreach($filename as $f) {
			if(strpos($_SERVER['PHP_SELF'], $f)) {
				$good = TRUE;
			}
		}
		
		return ($good) ? 'fa-circle' : 'fa-circle-o';
	}
	return (strpos($_SERVER['PHP_SELF'], $filename) !== FALSE) ? 'fa-circle' : 'fa-circle-o';
}

 
?>

