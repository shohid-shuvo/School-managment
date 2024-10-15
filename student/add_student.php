<?php
require('../database/connect.php');
$checkdb = new DB_Conn();
$connMsg = $checkdb->connectionMessage();

if (isset($_POST['stdn_submit'])) {
    // Check if all required fields are set
    if (isset($_POST['stnd_name'], $_POST['stnd_email'], $_POST['stnd_phone'], $_POST['stnd_dob'], $_POST['stnd_class']) && isset($_FILES['stnd_image'])) {
        
        // Sanitize and assign the POST data
        $name = htmlspecialchars($_POST['stnd_name']);
        $email = htmlspecialchars($_POST['stnd_email']);
        $phone = htmlspecialchars($_POST['stnd_phone']);
        $dob = htmlspecialchars($_POST['stnd_dob']);
        $class = htmlspecialchars($_POST['stnd_class']);
        $regDate = date('Y-m-d H:i:s'); // Set registration date

        // Handle the image upload
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

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["stnd_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["stnd_image"]["tmp_name"], $target_file)) {
                // Insert the student data into the database
                $db = new DB_Conn(); // Create a new database connection
                $query = "INSERT INTO sdl_student (name, email, phone, dob, class, image, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->dbStore->prepare($query);
                $stmt->bind_param("sssssss", $name, $email, $phone, $dob, $class, $target_file, $regDate);

                if ($stmt->execute()) {
                    echo "Student added successfully.";
                    header('Location: ../admin/index.php');
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
