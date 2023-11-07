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
        <div id="seeker">
            <div id="slogin">
                <font style="color: #CCBA96">
                    <form action="seeker.login.check.php" method="post" name="form_seekerlogin" onsubmit="return SeekerLogin">
                        <br />
                        <div>
                            <div>
                                <div align="right" class="div_left">
                                    <font color="#FF0000">*&nbsp;</font>Username
                                </div>
                                <div align="center" class="div_center"><b>:</b></div>
                                <div align="left" class="div_right">
                                    <input id="textbox" type="text" name="seeker_email_login" placeholder="Email-Id" />
                                </div>
                            </div><br /><br />
                            <div>
                                <div align="right" class="div_left">
                                    <font color="#FF0000">*&nbsp;</font>Password
                                </div>
                                <div align="center" class="div_center"><b>:</b></div>
                                <div align="left" class="div_right">
                                    <input id="textbox" type="password" name="seeker_pass_login" placeholder="" />
                                </div>
                            </div><br /><br />
                            <div>
                                <input id="button" type="submit" name="seeker_btn_login" value="Seeker Login" style="color:#CCBA96" />
                            </div>
                        </div>
                    </form>
                    <form action="seeker.forgot.password.php" method="post">
                        <div>
                            <input id="button" type="submit" name="seeker_btn_forgot" value="Forgot Password" style="color:#CCBA96" />
                        </div>
                    </form>
                    <form action="seeker.joinus.php" method="post">
                        <div>
                            <input id="button" type="submit" name="seeker_btn_join" value="Join Us Now" style="color:#CCBA96" />
                        </div>
                    </form>
                </font>
            </div> <!-- Corrected the div tag -->
        </div> <!-- Corrected the div tag -->
    </div> <!-- Corrected the div tag -->
</body>

<?php
include 'footer_bar.php';

if (isset($_SESSION['flag_seeker_logincheck']) && $_SESSION['flag_seeker_logincheck'] == 2) {
    echo '<script> alert("Username and Password are incorrect."); </script>';
    $_SESSION['flag_seeker_logincheck'] = 0;
    unset($_SESSION['flag_seeker_logincheck']);
}

if (isset($_SESSION['seek_loggedin']) && $_SESSION['seek_loggedin'] == 1) {
    echo '<script> alert("You are already logged in"); </script>';
    $_SESSION['seek_loggedin'] = 0;
    unset($_SESSION['seek_loggedin']);
}

if (isset($_SESSION['SEEK_JOINED']) && $_SESSION['SEEK_JOINED'] == 1) {
    echo '<script> alert("You are now joined with us. Login to access your account."); </script>';
    $_SESSION['SEEK_JOINED'] = 0;
    unset($_SESSION['SEEK_JOINED']);
}
?>

</html>
