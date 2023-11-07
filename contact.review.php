<?php 
ob_start();
session_start(); 

$conn = mysqli_connect('localhost', 'root', '', 'jobsportal');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/search.view.css" type="text/css" />
</head>

<body>
    <div align="center">
        <b><font color="#FFFFFF">Edit Contact Details</font></b>
    </div>
    
    <div id="body_struct" style="margin-top: 1.5%"><br />
    <?php
    $id = $_SESSION['SEEK_ID'];
    $query = "SELECT * FROM seeker_details WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);
    
    while($query_result = mysqli_fetch_array($query_run)) {
        // Display form elements to edit contact details
        // ...

        if(isset($_POST['save_contact_btn'])) {
            // Retrieve form data
            $fname = $_POST['edit_contact_fname'];
            $gender = $_POST['edit_contact_gender'];
            // Retrieve other fields...

            // Update the database
            $query_update = "UPDATE seeker_details SET fname='$fname', gender='$gender', ... WHERE id='$id'";
            $query_run_update = mysqli_query($conn, $query_update);

            if ($query_run_update) {
                header("Location: contact.review.php");
                exit;
            } else {
                echo "Failed to update contact details.";
            }
        }
    }
    ?>
    </div>

    <!-- Additional HTML or form closing tags should be placed here -->
</body>
</html>
