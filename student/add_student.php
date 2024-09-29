<?php
// Assuming you have code for student registration here

// Example: Student registration success check
$registration_success = true;  // Set this based on your registration logic

if ($registration_success) {
    // Require the Email class and send an email
    require_once '../classes/Email.php'; // Path to your Email class

    $email = new Email();
    $result = $email->send('movie001956@gmail.com', 'New Student Registered', 'A new student has been registered.');

    if ($result === true) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email: " . $result;
    }
}
?>
