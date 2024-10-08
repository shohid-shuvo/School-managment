<?php
require('../database/connect.php');
$checkdb = new DB_Conn();
$connMsg = $checkdb->connectionMessage();
session_start();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $user_name  = $_POST['user_name'];
    $password   = $_POST['pass']; 

    // Hash the password
    // $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $hashed_pass = md5($password);

    // Initialize an array to store errors
    $error = [];

    // Validate name field 
    if (empty($name)) {
        $error['name'] = "Input field is empty"; 
    }

    // Validate email field
    if (empty($email)) {
        $error['email'] = "Input field is empty";
    } else {
        // Check if the email already exists in the database
        $emailDuplicate = mysqli_query($checkdb->dbStore, "SELECT * FROM sdl_user WHERE email='$email'");
        if (mysqli_num_rows($emailDuplicate) > 0) {
            $error['email'] = "Email already exists";
        }
    }

    // Validate phone field
    if (empty($phone)) {
        $error['phone'] = "field empty";
    } else {
        // Validate the phone number format (11 digits)
        if (preg_match('/^[0-9]{11}$/', $phone)) {
            // Check if the phone number already exists in the database
            $checkDuplicate = mysqli_query($checkdb->dbStore, "SELECT * FROM sdl_user WHERE phone='$phone'");
            if (mysqli_num_rows($checkDuplicate) > 0) {
                $error['phone'] = "Already exists";
            }
        } else {
            $error['phone'] = "Phone number is not valid (must be 11 digits)";
        }
    }
    
    // Validate username field
    if (empty($user_name)) {
        $error['user_name'] = "Input field is empty";
    }

    // Validate password field
    if (empty($password)) {
        $error['pass'] = "Input field is empty";
    }

    // If there are no errors, proceed to insert data into the database
    if (empty($error)) {
        $isEmailVerify = 0;
        $regDate = date("Y-m-d H:i:s");
        $lastUpdationDate = date("Y-m-d H:i:s");
        $rend = str_shuffle('0123456789');
        $emailOtp = substr($rend, 0, 4); // Generate a random OTP

        // Insert data into the database
        $DB_query = $checkdb->insertData($name, $email, $phone, $user_name, $hashed_pass, $regDate, $emailOtp, $isEmailVerify, $lastUpdationDate);
        var_dump($DB_query); // Debugging line

        if ($DB_query) {
            $_SESSION['emailid'] = $email;

            // Code for sending the OTP via email
            require '../classes/email.php'; // Include the email class
            $emailSender = new Email();

            $otpBody = "Your OTP is: $emailOtp";
            $subject = "OTP for your account";

            // Send the OTP email
            if ($emailSender->send($email, $subject, $otpBody)) {
                echo "<script>alert('Data insertion successful. OTP has been sent to your email.');</script>";
                header('Location: /oop_project/user/otp.php');
            } else {
                echo "<script>alert('Data insertion successful but failed to send OTP.');</script>";
            }
        } else {
            echo "<script>alert('Data insertion failed.');</script>";
        }
    }   
}
?>
