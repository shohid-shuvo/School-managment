<?php
require_once('../database/connect.php'); // DB সংযোগের জন্য connect.php অন্তর্ভুক্ত করুন

$checkdb = new DB_Conn(); // DB_Conn ক্লাসের একটি উদাহরণ তৈরি করুন
$connMsg = $checkdb->connectionMessage(); // ডাটাবেস সংযোগের বার্তা নিন

// SQL কোয়েরি চালান শিক্ষার্থীদের তথ্য নিতে
$query = "SELECT * FROM sdl_student"; // sdl_student টেবিল থেকে সব তথ্য নিন
$result = mysqli_query($checkdb->dbStore, $query); // কোয়েরি চালান

if ($result) {
    // ডেটা বের করে টেবিলে প্রদর্শন করুন
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['dob']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($row['image']) . '" alt="Student Image" style="width:35px;height:35px;"></td>';
            echo '<td>' . $row['reg_date'] . '</td>';
            echo '<td>' . htmlspecialchars($row['class']) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="8">No students found.</td></tr>'; // কোনো শিক্ষার্থী না থাকলে প্রদর্শন করুন
}
?>
