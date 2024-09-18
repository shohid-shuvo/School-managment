<?php

require('./database/connect.php');
$checkdb = new DB_Conn();
$connMsg =  $checkdb->connectionMessage();


    // Check if the form is submitted
    
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $password = $_POST['pass'];

        $has_pass = md5($password);

        $query = mysqli_query($checkdb->dbStore, "SELECT * FROM sdl_user WHERE user_name = '$name' AND has_pass = '$has_pass'");
        if (mysqli_num_rows($query) > 0) {
            session_start();
            $_SESSION['uname'] = $name;
            header('location:/oop_project/admin/index.php');
        } else {
            echo "<script>alert('Invalid Username or Password');</script>";
        }
    }

        // $to_email = "shuvo001956@gmail.com";
        // $subject = "Simple Email Test via PHP";
        // $body = "Hi,nn This is test email send by PHP Script";
        // $headers = "shuvo001956@gmail.com";

        // if (mail($to_email, $subject, $body, $headers)) {
        //     echo "Email successfully sent to $to_email...";
        // } else {
        //     echo "Email sending failed...";
        // }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>

</head>
<body>
    <div class="sdl-login">
        <div class="container">
            <div class="login_cover d-md-flex g-5 p-md-3 p-lg-5 align-items-center">
                <div class="login_box">
                    <form class="sdl_form" action="" method="post">
                        <div class="user_icon">
                            <div class="user_circle"><img src="./assets/image/user.svg" alt="user_icon"></div>
                        </div>
                        <!-- <h1>LOGIN</h1> -->
                        <div class="group">
                            <input class="form-control" type="text" name="name" id="username" placeholder="Username" required>
                            <input class="form-control" type="password" name="pass" id="password" placeholder="Password" required>
                            <input class="form-control btn sdl_btn" name="submit" type="submit" value="LOGIN">
                        </div>
                    </form>
                    <div class="sign_up text-center">
                        <span> Don't have an account? Sign Up Now </span>
                        <a class="sign_up_url" href="./user/signup.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>