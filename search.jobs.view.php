<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Drive Info</title>
    <link rel="stylesheet" href="css/search.view.css" type="text/css" />
</head>

<body>

    <div id="body_struct">
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'jobsportal');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

        if ($id !== null) {
            $query = "SELECT * FROM job_details WHERE id='$id'";
            $query_run = $conn->query($query);

            if ($query_run->num_rows > 0) {
                while ($query_result = $query_run->fetch_assoc()) {
                    echo '<div><center><h2>' . $query_result['name'] . ' Walk-in Information </h2></center></div><br />';

                    // Other echo statements for job details...

                    // Handle session alerts
				
					if (isset($_SESSION['view_loggedin']) && $_SESSION['view_loggedin'] == 1) {
						echo '<script> alert("You are not logged in. Login then apply for this job"); </script>';
						$_SESSION['view_loggedin'] = 0;
						unset($_SESSION['view_loggedin']);
					} elseif (isset($_SESSION['job_applied']) && $_SESSION['job_applied'] == 1) {
						echo '<script> alert("Already Applied"); </script>';
						$_SESSION['job_applied'] = 0;
						unset($_SESSION['job_applied']);
					} elseif (isset($_SESSION['job_applied']) && $_SESSION['job_applied'] == 2) {
						echo '<script> alert("Applied Successfully"); </script>';
						$_SESSION['job_applied'] = 0;
						unset($_SESSION['job_applied']);
					}
				
				
                }
            } else {
                echo "No job found with the given ID.";
            }
        } else {
            echo "No ID provided.";
        }
        ?>
    </div>
</body>
</html>
