<?php include('partials/constants.php');
error_reporting(0);
?>
<?php
    if(!isset($_SESSION['user'])){
        $_SESSION['no-login-message']= "<div class='error'>Please login to access the Admin Panel!</div>";
        header("location:".SITEURL."admin/login.php");
    }

?> 