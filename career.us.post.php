<?php
ob_start();
session_start();
require 'db.connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_check = $_POST['career_email'];

    $query_select = "SELECT email_id FROM career_post WHERE email_id='" . $email_check . "'";
    $query_select_run = mysqli_query($connection, $query_select);

    if ($query_select_run) {
        $query_select_num = mysqli_num_rows($query_select_run);

        if ($query_select_num == 0) {
            $flag = 1;
        } else {
            echo '<script> alert("You had already posted your resume to us."); </script>';
            echo '<script> window.location.href = "career.us.php"; </script>';
        }
    }

    $query_id = "SELECT MAX(id) as max_id FROM career_post";
    $query_run_id = mysqli_query($connection, $query_id);
    $row = mysqli_fetch_assoc($query_run_id);
    $db_id = ($row['max_id']) ? $row['max_id'] + 1 : 1;

    if ($flag == 1 && isset($_POST['career_name']) && isset($_POST['career_email']) && isset($_POST['career_mob']) && isset($_POST['career_exp']) && isset($_POST['career_func_area']) && isset($_POST['career_button'])) {

        // Check other form inputs...

        if (!empty($_POST['career_name']) && !empty($_POST['career_email']) && !empty($_POST['career_mob']) && !empty($_FILES['career_resume']) && $_POST['career_exp'] != -1 && $_POST['career_func_area'] != -1) {

            $name = $_POST['career_name'];
            $email = $_POST['career_email'];
            $mobile = $_POST['career_mob'];
            $experience = $_POST['career_exp'];
            $func_area = $_POST['career_func_area'];

            $filename = $_FILES['career_resume']['name'];
            $new_filename = $db_id . '_' . $filename;
            $folder = 'upload/contactus_resume/';
            $format = pathinfo($filename, PATHINFO_EXTENSION);
            $upload_cv = $folder . $new_filename;

            $allowed_formats = array("doc", "docx");

            if (in_array($format, $allowed_formats)) {
                move_uploaded_file($_FILES['career_resume']['tmp_name'], $upload_cv);
                $_SESSION['flag_careerus'] = 1;
                $query = "INSERT INTO career_post VALUES ('', '$name', '$email', '$mobile', '$experience', '$func_area', '$upload_cv')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    header("Location: career.us.php");
                    exit;
                } else {
                    echo '<script> alert("Error in database insertion."); </script>';
                    echo '<script> window.location.href = "career.us.php"; </script>';
                }
            } else {
                $_SESSION['flag_careerus'] = 2;
                echo '<script> window.location.href = "career.us.php"; </script>';
            }
        } else {
            echo '<script> alert("Please fill in all required fields."); </script>';
            echo '<script> window.location.href = "career.us.php"; </script>';
        }
    } else {
        echo '<script> alert("Error in form submission."); </script>';
        echo '<script> window.location.href = "career.us.php"; </script>';
    }
}
?>
