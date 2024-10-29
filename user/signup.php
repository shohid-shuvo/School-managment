<?php
include('../inc/program_code.php');
// include('../inc/otp.php');
// session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="sdl-login sdl-signup">
        <div class="container">
            <div class="login_cover d-md-flex g-5 p-lg-5 align-items-center">
                <div class="login_box">
                    <h1>Create Your Account!</h1>
                    
                    <form id="signupForm" class="sdl_form" method="post">

                        <div class="user_icon">
                            <div class="user_circle">
                                <img src="../assets/image/user.svg" alt="user_icon" id="userIcon">
                            </div>
                            <!-- <input type="file" id="image" name="image" accept="image/*">
                            <p class="error-message" id="fileSizeError" style="display:none;">File size exceeds 500KB.</p>
                            <p class="error-message" id="fileFormatError" style="display:none;">Invalid file format. Allowed: jpg, jpeg, png, gif.</p> -->
                        </div>

                        <!-- FORM INPUT FIELD -->
                        <div class="group">
                            <div class="sdl_joint w-100 d-md-flex">
                                <div class="sdl_field_cvr w-md-50 me-md-3">
                                    <input class="form-control" type="text" name="name"
                                        value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>"
                                        id="name" placeholder="Full Name" required>
                                    <p class="error-message" id="nameError"><?php echo isset($error['name']) ? $error['name'] : ''; ?></p>
                                </div>
                                <div class="sdl_field_cvr w-md-50">
                                    <input class="form-control" type="text" name="phone"
                                        value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>"
                                        id="phone" placeholder="Phone" required>
                                    <p class="error-message" id="phoneError"><?php echo isset($error['phone']) ? $error['phone'] : ''; ?></p>
                                </div>
                            </div>
                            
                            <div class="sdl_field_cvr w-100">
                                <input class="form-control" type="email" name="email" 
                                    value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" 
                                    id="email" placeholder="Email" required>
                                <p class="error-message" id="emailError"><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>
                            </div>
                            <div class="sdl_field_cvr w-100">
                                <input class="form-control" type="text" name="user_name" 
                                    value="<?php echo isset($user_name) ? htmlspecialchars($user_name) : ''; ?>"
                                    id="user_name" placeholder="User Name" required>
                                <p class="error-message" id="userNameError"><?php echo isset($error['user_name']) ? $error['user_name'] : ''; ?></p>
                            </div>
                            <div class="sdl_field_cvr w-100">
                                <input class="form-control" type="password" name="pass" id="password" placeholder="Password" required>
                                <p class="error-message" id="passwordError"><?php echo isset($error['pass']) ? $error['pass'] : ''; ?></p>
                            </div>
                            
                            <div class="w-100 sdl_siupSubCovr">
                                <input class="form-control btn sdl_btn"  type="button" id="submitBtn" value="SIGN UP">
                                <div id="signUpLoading" style="display: none;">
                                    <img src="../assets/image/loading.gif" alt="Loading..." />
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('#submitBtn').on('click', function() {
                // Clear previous error messages
                $('.error-message').hide();

                // Gather form data
                var formData = new FormData($('#signupForm')[0]);

                $.ajax({
                    url: '../inc/program_code.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success or error messages based on response
                        // Assuming PHP returns JSON
                        var result = JSON.parse(response);
                        if (result.success) {
                            window.location.href = '/oop_project/user/otp.php';
                        } else {
                            $.each(result.errors, function(key, value) {
                                $('#' + key + 'Error').text(value).show();
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
