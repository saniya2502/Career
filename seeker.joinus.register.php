<?php
ob_start();
session_start();

require 'db.connect.php';

$flag = 0;
$email_check = strtolower($_POST['user_email']);

$query_select = "SELECT email_id FROM seeker_details WHERE email_id = ?";
$stmt = $mysqli->prepare($query_select);
$stmt->bind_param("s", $email_check);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $flag = 1;
} else {
    echo '<script> alert("You have already joined with us. Send a request to regain your password."); </script>';
    echo '<script> window.location.href = "seeker.forgot.password.php"; </script>';
}

$stmt->close();

if ($flag == 1) {
    if (
        isset($_POST['user_email']) && isset($_POST['user_pass']) && isset($_POST['user_fname']) &&
        isset($_POST['user_lname']) && isset($_POST['user_mob']) && isset($_POST['user_city']) &&
        isset($_POST['user_pincode']) && isset($_POST['user_key_skill']) &&
        isset($_POST['seeker_exp_ddl']) && isset($_POST['seeker_highest_course']) &&
        isset($_POST['seeker_register'])
    ) {
        if (isset($_FILES['seeker_resume'])) {
            $email = strtolower($_POST['user_email']);
            $password = password_hash($_POST['user_pass'], PASSWORD_BCRYPT); // Use bcrypt for password hashing.
            $fname = $_POST['user_fname'];
            $lname = $_POST['user_lname'];
            // ... (other variables)

            if (
                !empty($_POST['user_email']) && !empty($_POST['user_pass']) && !empty($_POST['user_fname']) &&
                !empty($_POST['seeker_gender']) && !empty($_POST['user_mob']) && !empty($_POST['user_city']) &&
                !empty($_POST['user_pincode']) && !empty($_POST['user_key_skill']) &&
                $_POST['seeker_exp_ddl'] != -1 && $_POST['seeker_highest_course'] != -1
            ) {
                $filename = $_FILES['seeker_resume']['name'];
                $new_filename = $db_id . '_' . $filename;
                $folder = 'upload/seeker_resume/';
                $format = pathinfo($filename, PATHINFO_EXTENSION);

                // Validate file format
                if ($format === 'doc' || $format === 'docx') {
                    $upload_cv = $folder . $db_id . '_' . $filename;
                    $upload_cv_txt = $folder . $db_id . '_' . pathinfo($filename, PATHINFO_FILENAME) . '.txt';
                    
                    if (move_uploaded_file($_FILES['seeker_resume']['tmp_name'], $folder . $new_filename)) {
                        $stmt = $mysqli->prepare("INSERT INTO seeker_details VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssss", $db_id, $email, $password, $fname, $lname, $gender, $marriage, $mobile, $phone, $address, $country, $state, $city, $pincode, $key_skill, $user_exp, $industry_type, $func_area, $high_course, $others, $hsc, $hsc_special, $hsc_percentage, $hsc_rollno, $hsc_college, $hsc_batch, $ssc, $ssc_special, $ssc_percentage, $ssc_rollno, $ssc_college, $ssc_batch, $bachelor, $bachelor_special, $bachelor_percentage, $bachelor_rollno, $bachelor_college, $bachelor_batch, $master, $master_special, $master_percentage, $master_rollno, $master_college, $master_batch, $upload_cv, $upload_cv_txt, $agree, $notification, $call_sms);
                        $stmt->execute();
                        $stmt->close();
                        
                        $_SESSION['SEEK_JOINED'] = 1;
                        echo '<script> window.location.href = "seeker.login.php"; </script>';
                    } else {
                        echo '<script> alert("Failed to upload the file."); </script>';
                    }
                } else {
                    echo '<script> alert("File not supported. Select only document file, i.e., .doc or .docx"); </script>';
                    echo '<script> window.location.href = "seeker.joinus.php"; </script>';
                }
            } else {
                echo '<script> alert("Fill all required fields first"); </script>';
                echo '<script> window.location.href = "seeker.joinus.php"; </script>';
            }
        } else {
            echo '<script> alert("File does not exist."); </script>';
            echo '<script> window.location.href = "seeker.joinus.php"; </script>';
        }
    }
}
?>
