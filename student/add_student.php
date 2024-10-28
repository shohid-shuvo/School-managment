<?php
require_once('../database/connect.php');
$checkdb = new DB_Conn();
$connMsg = $checkdb->connectionMessage();

if (isset($_POST['stdn_submit'])) {
    if (isset($_POST['stnd_name'], $_POST['stnd_email'], $_POST['stnd_phone'], $_POST['stnd_dob'], $_POST['stnd_class'])) {
        // Sanitize and assign the POST data
        $name = htmlspecialchars($_POST['stnd_name']);
        $email = htmlspecialchars($_POST['stnd_email']);
        $phone = htmlspecialchars($_POST['stnd_phone']);
        $dob = htmlspecialchars($_POST['stnd_dob']);
        $class = htmlspecialchars($_POST['stnd_class']);
        $regDate = date('Y-m-d H:i:s'); // Set registration date

        // Default image path if no file is uploaded
        $target_file = null;

        if (isset($_FILES['stnd_image']) && $_FILES['stnd_image']['error'] == 0) {
            // Handle the image upload if the file was provided
            $target_dir = "../uploads/student/";
            $target_file = $target_dir . basename($_FILES["stnd_image"]["name"]);
            $uploadOk = 1;

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["stnd_image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["stnd_image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
                ?> <script>alert('testing sdl')</script> <?php 
            }

            // Allow certain file formats
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // If everything is ok, try to upload file
            if ($uploadOk == 1) {
                if (!move_uploaded_file($_FILES["stnd_image"]["tmp_name"], $target_file)) {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                $target_file = null; // Set to null if upload failed
            }
        }
        

        // Insert the student data into the database
        $db = new DB_Conn(); // Create a new database connection
        $query = "INSERT INTO sdl_student (name, email, phone, dob, class, image, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->dbStore->prepare($query);
        $stmt->bind_param("sssssss", $name, $email, $phone, $dob, $class, $target_file, $regDate);

        if ($stmt->execute()) {
            echo "<script>alert('Student added successfully.');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill all fields.";
    }
}
?>


