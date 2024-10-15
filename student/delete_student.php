<?php
require('../database/connect.php');
require('../classes/Student.php');

$checkdb = new DB_Conn();
$student = new Student($checkdb->dbStore);

if ($_POST['id']) {
    $id = $_POST['id'];

    if ($student->deleteStudent($id)) {
        echo "Student deleted successfully!";
    } else {
        echo "Error deleting student.";
    }
}
?>
