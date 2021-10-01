<?php include('partials/menu.php'); ?>
<?php include('login-check.php'); ?>
<?php include('partials/constants.php'); ?>
<div class="content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br/><br/>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        
        ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name :</td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>
                    <tr>
                        <td>Username :</td>
                        <td>
                            <input type="text" name="username" placeholder="Your Username">
                        </td>
                    </tr>
                    <tr>
                        <td>Password :</td>
                        <td>
                            <input type="password" name="password" placeholder="Your Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php include('partials/footer.php'); ?>

<?php
//process
    //Get data from Form
    if(isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "INSERT INTO tbl_admin (full_name, username, password)
            VALUES ('$full_name','$username','$password')";
        $res = mysqli_query($conn,$sql) or die(mysqli_connect_error()) ;

        if($res == TRUE){
            //echo "ok!";
            $_SESSION['add'] = "Admin Added Success!";
            header("location: ".SITEURL.'admin/manage-admin.php');
        }else{
            //echo " not ok!";
            $_SESSION['add'] = "Failed to add Admin!";
            header("location: ".SITEURL.'admin/add-admin.php');
        }
    }
    //Exectring query and saving data to database
    
    
?>