<?php
require '../src/Student.php';

$student = new Student();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if ($student->updateStudent($id, $name, $email, $phone)) {
        echo "Student updated successfully!";
    } else {
        echo "Error updating student.";
    }
}

// Retrieve student data for pre-filling the form
$studentId = $_GET['id'];
$result = mysqli_query($student->db->dbStore, "SELECT * FROM sdl_user WHERE id = $studentId");
$studentData = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
</head>
<body>
    <h1>Update Student</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $studentData['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $studentData['name']; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $studentData['email']; ?>" required>
        <br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $studentData['phone']; ?>" required>
        <br>
        <button type="submit">Update Student</button>
    </form>
</body>
</html>
