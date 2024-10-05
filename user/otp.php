<?php
require('../database/connect.php');
require('../classes/email.php'); // Email class include kora
session_start(); // session start korte hobe

$checkdb = new DB_Conn();
$connMsg = $checkdb->connectionMessage();

$email = $_SESSION['emailid']; // session theke email niye ashchi

// OTP database theke ber kore email pathhano
$query = "SELECT emailOtp FROM sdl_user WHERE email = '$email'";
$result = mysqli_query($checkdb->dbStore, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $dbOtp = $row['emailOtp'];
} else {
    $dbOtp = null;
}

// Email pathhanor code
$emailSender = new Email();
$subject = "Your OTP Code";

if ($dbOtp) {
    $body = "Your OTP code is: " . $dbOtp;
    if ($emailSender->send($email, $subject, $body)) {
        echo "<script>alert('OTP has been sent to your email.');</script>";
    } else {
        echo "<script>alert('Failed to send OTP. Please try again.');</script>";
    }
} else {
    echo "<script>alert('No OTP found for this email. Please try again.');</script>";
}

// OTP verify korar form theke data ashle
if (isset($_POST['verify'])) {
    // user theke OTP input
    $userOtp = $_POST['otp'];

    // User input OTP and database er OTP match korano
    if ($dbOtp == $userOtp) {
        // OTP match hoile
        echo "<script>alert('OTP verified successfully!');</script>";
        
        // isEmailVerify update kore database e email verify kora
        $updateQuery = "UPDATE sdl_user SET isEmailVerify = 1 WHERE email = '$email'";
        mysqli_query($checkdb->dbStore, $updateQuery);

        // Success er por page redirect
        header('Location: /oop_project/index.php');
        exit();
    } else {
        // OTP match na korle error message
        echo "<script>alert('Invalid OTP. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Verify OTP</title>
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
                        <h1>Enter OTP Code</h1>
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
