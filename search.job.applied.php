<?php
ob_start();
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'jobsportal');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$job_id = $_REQUEST['job_id'];
$id = $_SESSION['SEEK_ID'];

if (!empty($id)) {
    $query = "SELECT * FROM seeker_details WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        $fname = $row['fname'];
        $lname = $row['lname'];
        $folder = 'upload/seeker_job_applied/';
        $filename = $folder . $id . '_' . $fname . " " . $lname . ".txt";
        $flag = 0;

        if (file_exists($filename)) {
            $applied_file = fopen($filename, 'r');
            $file_content = fread($applied_file, filesize($filename));
            fclose($applied_file);

            if (strpos($file_content, $job_id) !== false) {
                $_SESSION['job_applied'] = 1;
                header("Location: search.jobs.view.php?id=$job_id");
                exit;
            } else {
                $handle_append = fopen($filename, 'a');
                fwrite($handle_append, "\n" . $job_id . "\n");
                fclose($handle_append);
                $_SESSION['job_applied'] = 2;
                header("Location: search.jobs.view.php?id=$job_id");
                exit;
            }
        } else {
            $handle_write = fopen($filename, 'w');
            fwrite($handle_write, $job_id . "\n");
            fclose($handle_write);
            $_SESSION['job_applied'] = 2;
            header("Location: search.jobs.view.php?id=$job_id");
            exit;
        }
    }
} else {
    $_SESSION['view_loggedin'] = 1;
    header("Location: search.jobs.view.php?id=$job_id");
    exit;
}
?>
