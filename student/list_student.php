<?php include('../admin/header.php'); ?>
<?php include('../student/fetch_students.php'); ?>
<?php   include('../student/add_students.php'); ?>



<div class="sdl_studentListBody">
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
                        <form id="addStudentForm" method="POST" action="../student/add_student.php"  enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="stnd_name" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="stnd_email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="stnd_phone" class="form-control" id="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="stnd_image" class="form-control" id="image" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="stnd_dob" class="form-control" id="dob" required>
                            </div>
                            <div class="mb-3">
                                <label for="class" class="form-label">Class</label>
                                <input type="text" name="stnd_class" class="form-control" id="class" required>
                            </div>
                            <button type="submit" name="stdn_submit" class="btn btn-primary">Add Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


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
                                    </tr>
                                </thead>
                                <tbody id="studentListBody">
                                    <!-- Student data will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



<!-- *********** -->
 

<?php/ include('../admin/footer.php'); ?>
