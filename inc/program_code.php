<?php
require('../database/connect.php');
$checkdb = new DB_Conn();
$connMsg = $checkdb->connectionMessage();
session_start();

// Check if the AJAX request is made
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $user_name  = $_POST['user_name'];
    $password   = $_POST['pass']; 

    // Initialize an array to store errors
    $errors = [];

    // Validate name field 
    if (empty($name)) {
        $errors['name'] = "Input field is empty"; 
    }

    // Validate email field
    if (empty($email)) {
        $errors['email'] = "Input field is empty"; // Error if the field is empty
    } else {
        // Check if the email format is valid using preg_match
        if (!preg_match("/^[\w\-\.]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,6}$/", $email)) { // Purple: Regular expression for basic email validation
            $errors['email'] = "Invalid email format"; // Purple: Sets an error if the email format is invalid
        } else {
            // Check if the email already exists in the database
            $emailDuplicate = mysqli_query($checkdb->dbStore, "SELECT * FROM sdl_user WHERE email='$email'");
            if (mysqli_num_rows($emailDuplicate) > 0) {
                $errors['email'] = "Email already exists"; // Error if the email already exists
            }
        }
    }
    

    // Validate phone field
    if (empty($phone)) {
        $errors['phone'] = "Field empty";
    } else {
        // Validate the phone number format (11 digits)
        if (preg_match('/^[0-9]{11}$/', $phone)) {
            // Check if the phone number already exists in the database
            $checkDuplicate = mysqli_query($checkdb->dbStore, "SELECT * FROM sdl_user WHERE phone='$phone'");
            if (mysqli_num_rows($checkDuplicate) > 0) {
                $errors['phone'] = "Already exists";
            }
        } else {
            $errors['phone'] = "Phone number is not valid (must be 11 digits)";
        }
    }
    
    // Validate username field
    if (empty($user_name)) {
        $errors['user_name'] = "Input field is empty";
    }

    // Validate password field
    if (empty($password)) {
        $errors['pass'] = "Input field is empty";
    }

    // Prepare the response
    $response = ['success' => empty($errors), 'errors' => $errors];

    // If there are no errors, proceed to insert data into the database
    if (empty($errors)) {
        $hashed_pass = md5($password);
        $isEmailVerify = 0;
        $regDate = date("Y-m-d H:i:s");
        $lastUpdationDate = date("Y-m-d H:i:s");
        $rend = str_shuffle('0123456789');
        $emailOtp = substr($rend, 0, 4); // Generate a random OTP

        // Insert data into the database
        $DB_query = $checkdb->insertData($name, $email, $phone, $user_name, $hashed_pass, $regDate, $emailOtp, $isEmailVerify, $lastUpdationDate);

        if ($DB_query) {
            $_SESSION['emailid'] = $email;

            // Code for sending the OTP via email
            require '../classes/email.php'; // Include the email class
            $emailSender = new Email();

            $otpBody = "Your OTP is: $emailOtp";
            $subject = "OTP for your account";

            // Send the OTP email
            if ($emailSender->send($email, $subject, $otpBody)) {
                $response['success'] = true; // Indicate success
            } else {
                $response['errors']['otp'] = 'Failed to send OTP.';
            }
        } else {
            $response['errors']['database'] = 'Data insertion failed.';
        }
    }

    // Return JSON response
    echo json_encode($response);
    exit; // Ensure no further output is sent
}
?>
