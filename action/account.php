<?php
// Global includes
include('../include.php');

if($_SESSION['login'] != '1'){
	// not logged in, can't update any tables for noone
	alert(STR_ALERT_NOTLOGGEDIN, "error", MAIN_URL, 3);
}
else{
	// Only processing
	if('POST' == $_SERVER['REQUEST_METHOD']){
		switch($_POST['action']){
			
			case 'mail':
				if(!preg_match("/^.+@.+\..+$/", $_POST['email'])){
					// handle fake email
					alert(STR_ALERT_REGISTER_EMAIL, "error", MAIN_URL, 5);
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
						// actual changeing
						$query = "	UPDATE
										`time-t-able_users`
									SET
										email = \"".$_POST['email']."\"
									WHERE
										ID = \"".$_SESSION['ID']."\"";
						// perform query
						$check = $db->query($query);

						// check 
						if (!$check){
							die('Query Error: '.$db->error);
						}

						alert(STR_ALERT_CHANGED_EMAIL, "success", MAIN_URL, 5);
					}
					else{
						alert(STR_ALERT_WRONGPW, "error", MAIN_URL, 3);
					}
				}
			break;
			
			case 'username':
				if(!preg_match("/^[A-Za-z0-9]{3,30}$/", $_POST['username'])){
					// handle invalid username
					alert(STR_ALERT_REGISTER_INVALID_USERNAME, "error", MAIN_URL, 5);
				}
				$query = "	SELECT
								username
							FROM
								`time-t-able_users`
							WHERE
								1";
				$usernamecheck = $db->query($query);
				if(!$usernamecheck){
					die('Query Error:'.$db->error);
				}
				if($usernamecheck->num_rows){
					while($row = $usernamecheck->fetch_assoc()){
						if ($row['username'] == $_POST['username']){
							// handle taken username
							alert(STR_ALERT_REGISTER_TAKEN_USERNAME, "error", MAIN_URL, 5);
						}
					}
				}
				$query = "	UPDATE
								`time-t-able_users`
							SET
								username = \"".$_POST['username']."\"
							WHERE
								ID = \"".$_SESSION['ID']."\"";
				// perform query
				$check = $db->query($query);

				// check 
				if (!$check){
					die('Query Error: '.$db->error);
				}
				
				$_SESSION['username'] = $_POST['username'];
				
				alert(STR_ALERT_CHANGED_USERNAME, "success", MAIN_URL, 5);
			break;
			
			case 'password':
				if(!isset($_POST['oldpassword'], $_POST['newpassword'], $_POST['newpasswordconfirm'])){
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
					if ($row['pw_hash'] == sha1($_POST['oldpassword'])){
						// actual changing
						if($_POST['newpassword'] != $_POST['newpasswordconfirm']){
							// handle inconsistent passwords
							alert(STR_ALERT_REGISTER_PASSWORDS, "error", MAIN_URL, 5);
						}

						$query = "	UPDATE
										`time-t-able_users`
									SET
										pw_hash = \"".sha1($_POST['newpassword'])."\"
									WHERE
										ID = \"".$_SESSION['ID']."\"";
						// perform query
						$check = $db->query($query);

						// check 
						if (!$check){
							die('Query Error: '.$db->error);
						}


						alert(STR_ALERT_CHANGED_PASSWORD, "success", MAIN_URL, 5);
					}
					else{
						alert(STR_ALERT_WRONGPW, "error", MAIN_URL, 3);
					}
				}
			break;
			
			case 'delete':
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
						alert(STR_ALERT_WRONGPW, "error", MAIN_URL, 3);
					}
				}
			break;
		}
	}
}
?>