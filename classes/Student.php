<?php include('../admin/header.php'); ?> <!-- Include Header + Sidebar -->

<div class="title">
    <h1 class="text-center fw-bold my-4">Manage Student</h1>
</div>

<div id="contentArea">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card border-0 shadow">
                <div class="card-body p-5">
                    <!-- Responsive table -->
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Modifications</th>
                                </tr>
                            </thead>
                            <tbody id="studentListBody">
                                <!-- Dynamic student rows will be loaded here via Ajax -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../admin/footer.php'); ?> <!-- Include Footer -->
