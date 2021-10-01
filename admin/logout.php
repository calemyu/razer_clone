<?php include('partials/constants.php'); ?>
<?php

    //delete session
    session_destroy();

    header("location:".SITEURL."admin/login.php");


?>