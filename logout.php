<?php 
	ob_start();
	session_start();
?>

<?php
unset($_SESSION['EMP_ID']);
unset($_SESSION['SEEK_ID']);


$_SESSION['out'] = 1;
echo '<script> window.location.href = "index.php"; </script>';
?>