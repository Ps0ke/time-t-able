<?php
// Global includes
include('../include.php');

if($_SESSION['login'] == '1'){
	
	if(!isset($_POST['password'])){
		alert(STR_ALERT_INVALIDFORM, "error", MAIN_URL, 3);
	}
	// check for right password
	$query = "	SELECT
					pw_hash
				FROM
					`time-t-able_users`
				WHERE
					ID = ".$_SESSION['ID'];
	$passwordcheck = $db->query($query);
	if(!$passwordcheck){
		die('Query Error:'.$db->error);
	}
	if($passwordcheck->num_rows){
		$row = $passwordcheck->fetch_assoc();
		if ($row['pw_hash'] == sha1($_POST['password'])){
			// actual deleting
			$query =
				'DELETE FROM
					`time-t-able_users`
				WHERE
					ID = "'.$_SESSION['ID'].'";
				DELETE FROM
					`time-t-able_subjects`
				WHERE
					user_ID = "'.$_SESSION['ID'].'";
				DELETE FROM
					`time-t-able_times`
				WHERE
					user_ID = "'.$_SESSION['ID'].'";
				DELETE FROM
					`time-t-able_table`
				WHERE
					user_ID = "'.$_SESSION['ID'].'";';
					
			// perform multi_query
			$check = $db->multi_query($query);
				
			// check 
			if (!$check){
				die('Query Error: '.$db->error);
			}
			
			// manual logout
			$_SESSION = array();
			
			alert(STR_ALERT_DELETED, "success", MAIN_URL, 5);
		}
		else{
			alert(STR_ALERT_WRONGPW, "error", MAIN_URL.'#general', 3);
		}
	}
}
else{
	alert(STR_ALERT_NOTLOGGEDIN, "error", MAIN_URL, 3);
}
?>