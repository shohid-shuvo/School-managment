<?php
require '../src/Student.php';

$student = new Student();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if ($student->deleteStudent($id)) {
        echo "Student deleted successfully!";
    } else {
        echo "Error deleting student.";
    }
}

// Retrieve student data for confirmation
$studentId = $_GET['id'];
$result = mysqli_query($student->db->dbStore, "SELECT * FROM sdl_user WHERE id = $studentId");
$studentData = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
</head>
<body>
    <h1>Delete Student</h1>
    <p>Are you sure you want to delete student: <?php echo $studentData['name']; ?>?</p>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $studentData['id']; ?>">
        <button type="submit">Delete Student</button>
    </form>
    <a href="view_students.php">Cancel</a>
</body>
</html>
