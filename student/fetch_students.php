<?php
require_once('../database/connect.php'); 
$checkdb = new DB_Conn(); 
$connMsg = $checkdb->connectionMessage(); 
// import image from local directory

$query = "SELECT * FROM sdl_student"; 
$result = mysqli_query($checkdb->dbStore, $query); 

if ($result) {
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['dob']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($row['image']) . '" alt="no Image" style="width:35px;height:35px;"></td>';
            echo '<td>' . $row['reg_date'] . '</td>';
            echo '<td>' . htmlspecialchars($row['class']) . '</td>';


            // draft draft draft draft draft draft draft draft draft draft 
            ?>  
                <td>
                    <a id='delBtn' data-id='<?php echo $student_id?>' >Delete</a>
                </td>
                <!-- <td>
                    <a id="delBtn" href="javascript:confirmDelete('<?php// echo $row['id']; ?>')">Delete</a>
                </td> -->
                <script>
                    // function confirmDelete(id) {
                    //     if (confirm("Are you sure you want to delete this student?")) {
                    //         window.location.href = "delt_student.php?deleteid=" + id;
                    //     }
                    // }
                </script>
            <?php
            // draft draft draft draft draft draft draft draft 

            
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="8">No students found.</td></tr>'; 
}
?>
