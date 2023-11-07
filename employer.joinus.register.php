<?php
ob_start();
session_start();

require 'db.connect.php';

$flag = 0;
$email_check = strtolower($_POST['emp_email']);

$query_select = "SELECT email_id FROM emp_details WHERE email_id='$email_check'";
if ($query_select_run = mysqli_query($connection, $query_select)) {
    $query_select_num = mysqli_num_rows($query_select_run);
    if ($query_select_num == 0) {
        $flag = 1;
    } else {
        $flag = 0;
    }
}

if ($flag == 1) {
    if (
        isset($_POST['emp_user_name']) && isset($_POST['emp_email']) && isset($_POST['emp_pass']) && isset($_POST['emp_cmpname']) &&
        isset($_POST['emp_cmptype']) && isset($_POST['emp_add']) && isset($_POST['emp_city']) && isset($_POST['emp_state']) &&
        isset($_POST['emp_country']) && isset($_POST['emp_pincode']) && isset($_POST['emp_phno']) && isset($_POST['emp_name']) &&
        isset($_POST['emp_industry_type']) && isset($_POST['emp_gender'])
    ) {
        $name = $_POST['emp_name'];
        $username = $_POST['emp_user_name'];
        $email = strtolower($_POST['emp_email']);
        $password = md5($_POST['emp_pass']);
        $phone_no = $_POST['emp_phno'];
        $company_name = $_POST['emp_cmpname'];
        $company_type = $_POST['emp_cmptype'];
        $industry_type = $_POST['emp_industry_type'];
        $gender = $_POST['emp_gender'];
        $address = $_POST['emp_add'];
        $city = $_POST['emp_city'];
        $state = $_POST['emp_state'];
        $country = $_POST['emp_country'];
        $pin_code = $_POST['emp_pincode'];

        if (
            !empty($_POST['emp_user_name']) && !empty($_POST['emp_email']) && !empty($_POST['emp_pass']) && !empty($_POST['emp_cmpname']) &&
            !empty($_POST['emp_cmptype']) && !empty($_POST['emp_add']) && !empty($_POST['emp_city']) && !empty($_POST['emp_state']) &&
            !empty($_POST['emp_country']) && !empty($_POST['emp_pincode']) && !empty($_POST['emp_phno']) && !empty($_POST['emp_name']) &&
            !empty($_POST['emp_industry_type']) && !empty($_POST['emp_gender'])
        ) {
            $query = "INSERT INTO emp_details (name, username, email_id, password, gender, phone_no, company_name, company_type, industry_type, address, city, state, country, pin_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "sssssssssssss", $name, $username, $email, $password, $gender, $phone_no, $company_name, $company_type, $industry_type, $address, $city, $state, $country, $pin_code);
            mysqli_stmt_execute($stmt);

            $_SESSION['EMP_JOINED'] = 1;

            header('Location: employer.login.php');
            exit();
        } else {
            echo '<script> alert("Fill all required fields first"); </script>';
            header('Location: employer.joinus.php');
        }
    } else {
        echo '<script> alert("No file selected."); </script>';
        header('Location: employer.joiunus.php');
    }
} else {
    echo '<script> alert("You had already applied."); </script>';
    header('Location: employer.joinus.php');
}
?>
