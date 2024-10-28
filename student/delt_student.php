<?php
require_once('../database/connect.php'); 
$checkdb = new DB_Conn(); 

// Check if deleteid is set
if(isset($_POST['deleteid'])){
    $id = intval($_POST['deleteid']); // Ensure $id is an integer
    error_log("Delete ID received: $id"); // Debug: Log the received ID

    // Prepare and execute delete query
    $query = "DELETE FROM sdl_student WHERE id = ?";
    $stmt = mysqli_prepare($checkdb->dbStore, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo 'success';
    } else {
        error_log("Database error: " . mysqli_error($checkdb->dbStore)); // Log error
        echo 'failure';
    }

    mysqli_stmt_close($stmt);
} else {
    error_log("Delete ID not set in POST"); // Debug: Log if deleteid is missing
    echo 'failure';
}
?>
