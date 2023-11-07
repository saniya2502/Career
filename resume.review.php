<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/search.view.css" type="text/css" />
</head>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'jobsportal');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

<body>
<div style="margin-left: 45%">
    <b><font color="#FFFFFF">Upload New Resume</font></b>
</div>
<div id="body_struct" style="margin-top: 1.5%">
    <?php
    $id = $_SESSION['SEEK_ID'];
    $query = "SELECT resume FROM seeker_details WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($resume);

    while ($stmt->fetch()) {
        $handle = fopen($resume, 'r');
        while (($line = fgets($handle)) !== false) {
            echo $line . '<br />';
        }
        fclose($handle);
    }
    ?>
</div>

<div style="margin-left: 9.7%">
    <form action="resume.review.php" method="post" enctype="multipart/form-data">
        <input type="file" name="new_resume" />
        <input type="submit" name="upload_new_resume" value="Save" style="margin-left: 65%; -webkit-border-radius: 8px; font-size: 15px;">
    </form>
</div>
</body>

<?php
if (isset($_POST['upload_new_resume'])) {
    if (isset($_FILES['new_resume'])) {
        $id = $_SESSION['SEEK_ID'];
        $upload_dir = 'upload/seeker_resume/';
        $format = pathinfo($_FILES['new_resume']['name'], PATHINFO_EXTENSION);
        $new_filename = $id . '_' . $_FILES['new_resume']['name'];
        $upload_cv = $upload_dir . $new_filename;

        if ($format === 'doc' || $format === 'docx') {
            move_uploaded_file($_FILES['new_resume']['tmp_name'], $upload_cv);
            $query = "UPDATE seeker_details SET resume = ? WHERE id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("si", $upload_cv, $id);
            if ($stmt->execute()) {
                echo '<script>alert("Resume uploaded successfully");</script>';
            } else {
                echo '<script>alert("Failed to upload resume");</script>';
            }
        } else {
            echo '<script>alert("File not supported. Select only document file i.e., .doc or .docx");</script>';
        }
    }
}
?>
</html>
