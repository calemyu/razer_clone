<?php include('partials-front/menu.php'); ?>


<section class="contact">
    <div class="container text-center">
        <h1 class="text-center">問い合わせ</h1>
            <form action="" method="POST">
                
                <input type="text" name="name" placeholder="名前"><br>
                <input type="text" name="email" placeholder="メールアドレス"><br>
                <textarea name="message" placeholder="内容"></textarea>
                <br>
                <input type="submit" class="btn-primary" name="submit" value="送信">
            </form>            
    </div>
</section>
<?php
    if(isset($_POST['submit'])){
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $name = $_POST['name'];
        $email = $_POST['email'];
        $msg = $_POST['message'];

        $to = "enricoreinhardi37@gmail.com";
        $subject = "'$name' has been sent a mail";

        $message ="
        <html>
            <body>
                <table style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>Name: </strong></td>
                            <td style='width:400px'>$name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Email ID: </strong></td>
                            <td style='width:400px'>$email</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Message: </strong></td>
                            <td style='width:400px'>$msg</td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Admin <admin@websapex.com>' . "\r\n";

        if(mb_send_mail($to,$subject,$message,$headers)){
            echo "ok!";
        }else{
            echo "failed!";
        }
    }

?>  




<?php include('partials-front/footer.php'); ?>