<?php
require('../database/connect.php');
require('../classes/Student.php');

$checkdb = new DB_Conn();
$student = new Student($checkdb->dbStore);

if ($_POST) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    if ($student->updateStudent($id, $name, $email, $age)) {
        echo "Student updated successfully!";
    } else {
        echo "Error updating student.";
    }
}
?>
