<?php
require 'db.connect.php'; // Ensure the correct inclusion of the database connection file

// Current Date
$current_date = date('Y-m-d');

$query = "SELECT * FROM job_details";
$query_jobs = mysqli_query($conn, $query);

echo '<table border="1">
        <tr>
            <td><center><b>Name</b></center></td>
            <td><center><b>Profile</b></center></td>
            <td><center><b>Key Skill</b></center></td>
            <td><center><b>Location</b></center></td>
            <td><center><b>CTC</b></center></td>
            <td><center><b>More</b></center></td>
        </tr>';

if (mysqli_num_rows($query_jobs) > 0) {
    while ($query_jobs_result = mysqli_fetch_assoc($query_jobs)) {
        echo '<tr>
                <td><center>' . $query_jobs_result['name'] . '</center></td>
                <td><center>' . $query_jobs_result['profile'] . '</center></td>
                <td><center>' . $query_jobs_result['key_skill'] . '</center></td>
                <td><center>' . $query_jobs_result['location'] . '</center></td>
                <td><center>' . $query_jobs_result['ctc'] . '</center></td>
                <td><center>
                    <a href="search.jobs.view.php?id=' . $query_jobs_result['id'] . '">Click for Details</a>
                </center></td>
            </tr>';
    }
}

echo '</table>';
?>
