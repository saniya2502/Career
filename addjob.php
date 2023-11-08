<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="css/master.css" type="text/css" />
   
</head>

<?php
if (!empty($_SESSION['EMP_ID']) || !empty($_SESSION['SEEK_ID'])) {
    include 'title_bar.loggedin.php';
    include 'navigation.navi.bar.php';
} else {
    include 'title_bar.php';
    include 'navigation_bar.php';
}
?>

<body>
    <!-- Start of Body Struct Div -->
    <div id="body_struct">

        <!-- Start of Search Div -->
        <div id="search">

            <!-- Start of Body Heading Div -->
            <div class="heading">
                <div style="float: left; width: 95%">Search Jobs</div>
                <div style="float: left; width: 2%"><a href="seeker.joinus.php" style="text-decoration:none; color:#FF0000">&laquo;</a></div>
                <div style="float: left; width: 1%"><a href="search.job.fairs.php" style="text-decoration:none; color:#FF0000">&raquo;</a></div>
            </div clas="heading">
            <!-- End of Body Heading Div -->

            <!-- Start of Search Body Div -->
            <div id="search_body">
                <br /><br /><br />

                <!-- Start of Search Jobs Form -->
                <form action="search.jobs.search.php" method="post">
                    <?php
                    // print_r($_SESSION);
                    ?>
                </form>

                <form action="controller/addjob.php" method="post">
                    <label for="companyName">Company Name:</label><br>
                    <input type="text" id="companyName" name="companyName"><br><br>

                    <label for="profileName">Profile Name:</label><br>
                    <input type="text" id="profileName" name="profileName"><br><br>

                    <label for="keySkill">Key Skill:</label><br>
                    <input type="text" id="keySkill" name="keySkill"><br><br>

                    <label for="location">Location:</label><br>
                    <input type="text" id="location" name="location"><br><br>

                    <label for="ctc">CTC (Cost to Company):</label><br>
                    <input type="text" id="ctc" name="ctc"><br><br>

                    <input type="submit" value="Submit">
                </form>
                <!-- End of Search Jobs Form -->

            </div id="search_body">
            <!-- End of Search Body Div -->

            <!-- End of Search Div -->
        </div id="search">

    </div id="body_struct">
    <!-- End of Body Struct Div -->
</body>
<?php
include 'footer_bar.php';
?>

</html>