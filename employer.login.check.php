<?php
	ob_start();
	session_start();
	
	require 'db.connect.php';
	
	if (empty($_SESSION['EMP_ID']) && empty($_SESSION['SEEK_ID'])) {
		if (isset($_POST['emp_email_login']) && isset($_POST['emp_pass_login'])) {
			$emp_login_email = strtolower($_POST['emp_email_login']);
			$emp_login_pass = md5($_POST['emp_pass_login']);
			
			if (!empty($_POST['emp_email_login']) && !empty($_POST['emp_pass_login'])) {
				$query = "SELECT emp_id FROM emp_details WHERE email_id='$emp_login_email' AND password='$emp_login_pass'";
				
				$query_run = mysqli_query($conn, $query);
				
				if ($query_run) {
					$query_num_rows = mysqli_num_rows($query_run);
					
					if ($query_num_rows == 0) {
						$_SESSION['flag_emp_logincheck'] = 2;
						header('Location: employer.login.php');
						exit; // Add exit after redirect
					} else if ($query_num_rows == 1) {
						$row = mysqli_fetch_assoc($query_run);
						$_SESSION['EMP_ID'] = $row['emp_id'];
						$_SESSION['flag_emp_logincheck'] = 1;
						header('Location: index.php');
						exit; // Add exit after redirect
					}
				}
			}
		}
	}
	else {
		$_SESSION['emp_loggedin'] = 1;
		header('Location: employer.login.php');
		exit; // Add exit after redirect
	}
?>
