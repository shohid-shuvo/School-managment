<?php include('../admin/header.php'); ?> 	 <!-- have header + sidebar -->  

<div class="sdl-login sdl-signup sdl_stdnt">
        <div class="container">
            <div class="login_cover d-md-flex  g-5 py-3 py-lg-5 ">
                <div class="login_box">
                    <h1>Student Admission From</h1>
                    
                    <form class="sdl_form"  method="post">

                        <!-- <div class="user_icon">
                            <div class="user_circle">
                                <img src="../assets/image/user.svg" alt="user_icon">
                            </div> -->
                            <!-- <label class="user_phto_lbl" for="userphoto"> Add Photo</label> -->
                            <!-- <input type="file" name="userphoto" class="d-none" id="userphoto" accept="image/*"> -->
                        <!-- </div> -->
                                            <!-- FORM INPUT FIELD -->
                        <div class="group">
                            <div class="sdl_joint w-100 d-md-flex" >
                                <div class="sdl_field_cvr  me-md-3">
                                    <input class="form-control" type="text" name="name"
                                     value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>"
                                     id="name" placeholder="Full Name"  required>
                                    <?php if(isset($error['name'])){ echo '<p>'. $error['name']. '</p>';} ?>
                                </div>
                                <div class="sdl_field_cvr ">
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


<?php include('../admin/footer.php'); ?>    <!-- FOOTER include from (footer.php) page -->  
