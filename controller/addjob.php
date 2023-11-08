<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $companyName = $_POST['companyName'];
    $profileName = $_POST['profileName'];
    $keySkill = $_POST['keySkill'];
    $location = $_POST['location'];
    $ctc = $_POST['ctc'];

    // Connect to your MySQL database
    $servername = "localhost"; // Usually "localhost"
    $username = "root";
    $password = "";
    $dbname = "jobsportal";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into the table
    $sql = "INSERT INTO job_details (name, profile, key_skill, location, ctc) 
            VALUES ('$companyName', '$profileName', '$keySkill', '$location', '$ctc')";

    if ($conn->query($sql) === TRUE) {
        header('location:../search.job.fairs.php');
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        header('location:../search.job.fairs.php?msg='.$conn->error);
    }

    $conn->close();
}
?>
