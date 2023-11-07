<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/search.view.css" type="text/css" />
</head>

<body>
<div align="center">
    <b><font color="#FFFFFF">Edit Contact Details</font></b>
</div>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'jobsportal');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

<div id="body_struct" style="margin-top: 1.5%"><br />

    <?php
    $id = $_SESSION['SEEK_ID'];
    $query = "SELECT * FROM seeker_details WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($query_result = $result->fetch_assoc()) {
        echo '	<div class="div_struct"><center><b>Edit Contact Details</b></center></div><br /><br />';

        echo '	<div class="div_left">';

        if (empty($_POST['edit_contact_btn'])) {
            echo '	<br /><br />';
            echo '	<div class="div_struct"><b>First Name : </b>' . $query_result['fname'] . '</div><br />';
            echo '	<div class="div_struct"><b>Gender : </b>' . $query_result['gender'] . '</div><br />';
            echo '	<div class="div_struct"><b>Mobile : </b>' . $query_result['mobile'] . '</div><br />';
            echo '	<div class="div_struct"><b>Address : </b>' . $query_result['address'] . '</div><br />';
            echo '	<div class="div_struct"><b>State : </b>' . $query_result['state'] . '</div><br />';
            echo '	<div class="div_struct"><b>Pin Code : </b>' . $query_result['pincode'] . '</div><br /><br />';
        }

        echo '	</div class="div_left">';

        echo '	<div class="div_right">';

        if (empty($_POST['edit_contact_btn'])) {
            echo '	<form action="contact.review.php" method="post"/>';
            echo '		<input type="submit" name="edit_contact_btn" value="Edit Details" style="float: right; margin-right: 10%" />';
            echo '	</font>';
            echo '	<br /><br />';
            echo '	<div class="div_struct"><b>Surname : </b>' . $query_result['lname'] . '</div><br />';
            echo '	<div class="div_struct"><b>Marriage Status : </b>' . $query_result['marriage_status'] . '</div><br />';
            echo '	<div class="div_struct"><b>Home Number : </b>' . $query_result['phone'] . '</div><br />';
            echo '	<div class="div_struct"><b>City : </b>' . $query_result['city'] . '</div><br />';
            echo '	<div class="div_struct"><b>Country : </b>' . $query_result['country'] . '</div><br /><br />';
        }

        echo '	</div class="div_right">';

        echo '	<div class="div_left">';

        if (!empty($_POST['edit_contact_btn'])) {
            echo '	<form action="contact.review.php" method="post"/>';
            echo '	<br /><br />';
            echo '	<div class="div_struct">';
            echo ' 	<div style="float:left;width: 30%"><b>First Name</b></div>';
            echo '	<div style="float:left;width: 10%">:</div>';
            echo '	<div style="float:left;width: 60%">';
            echo '		<input type="text" name="edit_contact_fname" value="' . $query_result['fname'] . '"/>';
            echo '	</div>';
            echo
