<?php
require('../database/connect.php');
$checkdb = new DB_Conn();
$connMsg =  $checkdb->connectionMessage();


// +===========================
        // Check if the form is submitted
        if (isset($_POST['verify'])) {
            // Retrieve and sanitize form data
            $email      = $_SESSION['emailid'];  // Assuming email is stored in session
            $userOtp    = $_POST['otp'];         // OTP provided by the user
            
            // Retrieve the OTP from the database for the given email
            $stmt = $checkdb->dbStore->prepare("SELECT emailOtp FROM sdl_user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($dbOtp);
            $stmt->fetch();
            $stmt->close();
            
            // Compare the OTP entered by the user with the one stored in the database
            if ($dbOtp == $userOtp) {
                // OTP is correct
                echo "<script>alert('OTP verified successfully!');</script>";
                
                // You can also update the user's verification status in the database, for example:
                $stmt = $checkdb->dbStore->prepare("UPDATE sdl_user SET isEmailVerify = 1 WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->close();
                
                // Redirect to another page or display success message
                header('Location: /oop_project/index.php');
                exit();
            } else {
                // OTP is incorrect
                echo "<script>alert('Invalid OTP. Please try again.');</script>";
            }
        }

    // +===========================
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Login</title>

</head>
<body>
    <div class="sdl-login">
        <div class="container">
            <div class="login_cover d-md-flex g-5 p-md-3 p-lg-5 align-items-center">
                <div class="login_box">
                    <form class="sdl_form" action="" method="post">
                        <div class="user_icon">
                            <div class="user_circle"><img src="../assets/image/user.svg" alt="user_icon"></div>
                        </div>
                        <h1>Enter OTP Code </h1>
                        <h6>Check your Email</h6>
                        <div class="group">
                            <input class="form-control" type="text" name="otp" id="otp" placeholder="Enter OTP" required>
                            <!-- submit button -->
                            <input class="form-control btn sdl_btn" type="submit" name="verify" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/app.js"></script>

</body>
</html>

<?php
session_encode();
?>