<?php
require('../database/connect.php');
$checkdb = new DB_Conn();
$connMsg = $checkdb->connectionMessage();
// echo $connMsg;

if (isset($_POST['stdn_submit'])) {
    // Check if all required fields are set
    if (isset($_POST['stdn_name'], $_POST['stdn_email'], $_POST['stdn_phone'], $_POST['stdn_dob'], $_POST['stdn_class']) && isset($_FILES['stdn_image'])) {
        // Sanitize and assign the POST data
        $name = htmlspecialchars($_POST['stdn_name']);
        $email = htmlspecialchars($_POST['stdn_email']);
        $phone = htmlspecialchars($_POST['stdn_phone']);
        $dob = htmlspecialchars($_POST['stdn_dob']);
        $class = htmlspecialchars($_POST['stdn_class']);

        // Handle the image upload
        $target_dir = "../uploads/student/";
        $target_file = $target_dir . basename($_FILES["stdn_image"]["stdn_name"]);
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["stdn_image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["stdn_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if(!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["stdn_image"]["tmp_name"], $target_file)) {
                // Insert the student data into the database
                $db = new DB_Conn(); // Create a new database connection
                $query = "INSERT INTO sdl_student (name, email, phone, dob, image, class, reg_date) VALUES ('$name', '$email', '$phone', '$dob', '$class', '$target_file', '$regDate')";
                $stmt = $db->dbStore->prepare($query);
                $stmt->bind_param("ssssss", $name, $email, $phone, $dob, $target_file, $class);

                if ($stmt->execute()) {
                    echo "Student added successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Please fill all fields.";
    }
} else {
    echo "Invalid request method.";
}
?>

