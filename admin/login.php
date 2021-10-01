<?php include('partials/constants.php'); ?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin1.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php

                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset ($_SESSION['no-login-message']);
                }
                
            ?>
            <br><br>



            <form action="" method="POST" class="text-center">
                Username:
                <input type="text" name="username" placeholder="Username"/>
                <br/><br/>
                Password:
                <input type="password" name="password" placeholder="Password">
                <br/><br/>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <br/>
            <p class="text-center">E19C3020 <a href="#">E19C3020</a></p>
        </div>
    </body>
</html>

<?php

    if(isset($_POST['submit'])){
        //get data
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        //create query
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
        //execute query
        $res = mysqli_query($conn,$sql);
        //check user exists or not
        $count = mysqli_num_rows($res);
        if($count == 1){
            $_SESSION['login']= "<div class='success'>Login Successful.</div>";
            $_SESSION['user']= $username;

            header("location:".SITEURL."admin/");
        }else{
            $_SESSION['login']= "<div class='error'>Username or Password did not match.</div>";
            header("location:".SITEURL."admin/login.php");
        }
    }

?>
