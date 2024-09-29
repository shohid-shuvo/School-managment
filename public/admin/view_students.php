<?php
require '../src/Student.php';

$student = new Student();
$students = $student->getAllStudents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Students</title>
</head>
<body>
    <h1>Students List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $studentData): ?>
        <tr>
            <td><?php echo $studentData['id']; ?></td>
            <td><?php echo $studentData['name']; ?></td>
            <td><?php echo $studentData['email']; ?></td>
            <td><?php echo $studentData['phone']; ?></td>
            <td>
                <a href="update_student.php?id=<?php echo $studentData['id']; ?>">Update</a>
                <a href="delete_student.php?id=<?php echo $studentData['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="add_student.php">Add New Student</a>
</body>
</html>
