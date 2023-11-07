<?php
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>CareerJump.com</title>
</head>

<?php
if (!empty($_SESSION['EMP_ID']) || !empty($_SESSION['SEEK_ID'])) {
    include 'title_bar.loggedin.php';
    include 'navigation.navi.bar.php';
} else {
    include 'title_bar.php';
    include 'navigation_bar.php';
}

include 'slider.php';
include 'footer_bar.php';

if (isset($_SESSION['out']) && $_SESSION['out'] == 1) {
    echo '<script> alert("You are logged out. Thank you for your visit."); </script>';
    $_SESSION['out'] = 0;
    unset($_SESSION['out']);
}

if (isset($_SESSION['flag_seeker_logincheck']) && $_SESSION['flag_seeker_logincheck'] == 1) {
    echo '<script> alert("Username and Password are Correct. Welcome to CareerJump.com"); </script>';
    $_SESSION['flag_seeker_logincheck'] = 0;
    unset($_SESSION['flag_seeker_logincheck']);
}

if (isset($_SESSION['flag_emp_logincheck']) && $_SESSION['flag_emp_logincheck'] == 1) {
    echo '<script> alert("Username and Password are Correct. Welcome to CareerJump.com"); </script>';
    $_SESSION['flag_emp_logincheck'] = 0;
    unset($_SESSION['flag_emp_logincheck']);
}
?>

<body>
    <!-- Your HTML body content goes here -->
</body>

</html>
