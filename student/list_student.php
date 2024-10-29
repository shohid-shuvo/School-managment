<?php require_once('../admin/header.php'); ?>
<?php   require_once('../student/add_student.php'); 

// database connection
require_once('../database/connect.php'); 
$checkdb = new DB_Conn(); 
$query = "SELECT * FROM sdl_student"; 
$result = mysqli_query($checkdb->dbStore, $query); 

?>
    <!-- STUDENT ADD  -->
    <div class="sdl_studentListBody">
        <h1 class="text-center fw-bold my-4">Manage Students</h1>

        <!-- Add Student Button -->
        <button id="addStudentButton" class="btn btn-primary mb-4 ms-5" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>

        <!-- Add Student Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                            <!-- start form -->

                        <form id="addStudentForm" method="POST" action="../student/list_student.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="stnd_name" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="stnd_email" class="form-control" id="email" >
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="stnd_phone" class="form-control" id="phone" >
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="stnd_image" class="form-control" id="image" accept="image/*">
                                <span id="fileSizeError" style="color: red; display: none;">File size must be less than 500KB.</span>
                                <span id="fileFormatError" style="color: red; display: none;">Only JPG, JPEG, PNG & GIF files are allowed.</span>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="stnd_dob" class="form-control" id="dob" >
                            </div>
                            <div class="mb-3">
                                <label for="class" class="form-label">Class</label>
                                <input type="text" name="stnd_class" class="form-control" id="class" >
                            </div>
                            <button type="submit" name="stdn_submit" class="btn btn-primary" id="stdn_submit">Add Student</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>


        
        <div id="custom-alert" style="display: none; background-color: #4CAF50; color: white; padding: 10px; position: fixed; top: 10px; right: 10px; z-index: 1000;">
            Student added successfully.
        </div>
        



        <!-- student list table -->
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Reg Date</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="studentListBody">
                                    <!-- Student data will be loaded here -->
                                    <?php //  include('../student/fetch_students.php'); 
                                    
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $student_id = $row['id'];
                                            echo '<tr>';
                                                echo '<td>' . $row['id'] . '</td>';
                                                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['dob']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
                                                echo '<td><img src="' . htmlspecialchars($row['image']) . '" alt="no Image" style="width:35px;height:35px;"></td>';
                                                echo '<td>' . $row['reg_date'] . '</td>';
                                                echo '<td>' . htmlspecialchars($row['class']) . '</td>';
                                                ?>  
                                                <td class="sdl_dlt">
                                                    <a id='delBtn' data-id='<?php echo $student_id?>' >Delete</a>
                                                    <!-- Loading Spinner, initially hidden -->
                                                    <div id="loadingSpinner" style="display: none;">
                                                        <img src="../assets/image/loading1.gif" alt="Loading..." />
                                                    </div>
                                                </td>
                                                <?php
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="8">No students found.</td></tr>'; 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- *********** -->

<?php include('../admin/footer.php'); ?>

