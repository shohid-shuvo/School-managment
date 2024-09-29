<?php
require '/src/Student.php';

$student = new Student();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if ($student->addStudent($name, $email, $phone)) {
        echo "Student added successfully!";
    } else {
        echo "Error adding student.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" required>
        <br>
        <button type="submit">Add Student</button>
    </form>
</body>
</html>
