<?php
	ob_start();
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/master.css" type="text/css" />
	<script type="text/javascript" src="js/login.check.js"></script>
</head>

<?php
	if (!empty($_SESSION['EMP_ID']) || !empty($_SESSION['SEEK_ID'])) {
		include 'title_bar.loggedin.php';
		include 'navigation.navi.bar.php';
	} else {
		include 'title_bar.php';
		include 'navigation_bar.php';
	}
?>
<body>
	<div id="body_struct">
		<div id="employer">
			<div id="elogin">
				<font style="color: #222f50">			
					<form action="employer.login.check.php" method="post" name="form_emplogin" onsubmit="return EmpLogin()">
						<br />
						<div>
							<div align="right" class="div_left"><font color="#FF0000">*&nbsp;</font>Username</div>
							<div align="center" class="div_center"><b>:</b></div>
							<div align="left" class="div_right">
								<input id="textbox" type="text" name="emp_email_login" placeholder="Email-Id"/>
							</div>
						</div><br /><br />
						<div>
							<div align="right" class="div_left"><font color="#FF0000">*&nbsp;</font>Password</div>
							<div align="center" class="div_center"><b>:</b></div>
							<div align="left" class="div_right">
								<input id="textbox" type="password" name="emp_pass_login" placeholder="Password" />
							</div>
						</div><br /><br />
						<div>
							<input id="button" type="submit" name="emp_btn_login" value="Employer Login" style="color:#222f50" />
						</div>
					</form>
					<form action="employer.forgot.password.php" method="post">
						<div>
							<input id="button" type="submit" name="emp_btn_forgot" value="Forgot Password" style="color:#222f50" />
						</div>
					</form>
					<form action="employer.joinus.php" method="post">
						<div>
							<input id="button" type="submit" name="emp_btn_join" value="Join Us Now" style="color:#222f50" />
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>
</body>

<?php
include 'footer_bar.php';

if (isset($_SESSION['flag_emp_logincheck']) && $_SESSION['flag_emp_logincheck'] == 2) {
	echo '<script> alert("Username and Password are incorrect."); </script>';
	$_SESSION['flag_emp_logincheck'] = 0;
	unset($_SESSION['flag_emp_logincheck']); 
}

if (isset($_SESSION['emp_loggedin']) && $_SESSION['emp_loggedin'] == 1) {
	echo '<script> alert("You are already logged in"); </script>';
	$_SESSION['emp_loggedin'] = 0;
	unset($_SESSION['emp_loggedin']);
}

if (isset($_SESSION['EMP_JOINED']) && $_SESSION['EMP_JOINED'] == 1) {
	echo '<script> alert("You are now joined with us. Login to access your account."); </script>';
	$_SESSION['EMP_JOINED'] = 0;
	unset($_SESSION['EMP_JOINED']);
}
?>

</html>
