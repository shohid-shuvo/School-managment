
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
                    
                    <form class="sdl_form"  method="post">

                        <div class="user_icon">
                            <div class="user_circle">
                                <img src="../assets/image/user.svg" alt="user_icon">
                            </div>
                            <!-- <label class="user_phto_lbl" for="userphoto"> Add Photo</label> -->
                            <!-- <input type="file" name="userphoto" class="d-none" id="userphoto" accept="image/*"> -->
                        </div>
                                            <!-- FORM INPUT FIELD -->
                        <div class="group">
                            <div class="sdl_joint w-100 d-md-flex" >
                                <div class="sdl_field_cvr w-md-50 me-md-3">
                                    <input class="form-control" type="text" name="name"
                                     value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>"
                                     id="name" placeholder="Full Name"  required>
                                    <?php if(isset($error['name'])){ echo '<p>'. $error['name']. '</p>';} ?>
                                </div>
                                <div class="sdl_field_cvr w-md-50">
                                <input class="form-control" type="text" name="phone"
                                value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>"
                                id="phone" placeholder="Phone"  required>
                                <?php if(isset($error['phone'])){ echo '<p>'. $error['phone']. '</p>';} ?>
                                </div>
                            </div>
                                
                            <div class="sdl_field_cvr w-100">
                                
                                <input class="form-control" type="email" name="email" 
                                    value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" 
                                     id="email" placeholder="Email"  required>
                                    <?php if(isset($error['email'])){ echo '<p>'. $error['email']. '</p>';} ?>
                            </div>
                            <div class="sdl_field_cvr w-100">
                                <input class="form-control" type="text" name="user_name" 
                                value="<?php echo isset($user_name) ? htmlspecialchars($user_name) : ''; ?>"
                                id="user_name" placeholder="User Name"  required>
                                <?php if(isset($error['user_name'])){ echo '<p>'. $error['user_name']. '</p>';} ?>
                            </div>
                            <div class="sdl_field_cvr w-100">
                                <input class="form-control" type="password" name="pass" id="password" placeholder="Password"  required>
                                <?php if(isset($error['pass'])){ echo '<p>'. $error['pass']. '</p>';} ?>
                            </div>
                            
                            <input class="form-control btn sdl_btn"  type="submit" name="submit" value="SIGN UP">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>