<?php

     include_once ("../layouts/header2.php") ;
     include_once ("../../connection/connect.php");
?>
<div class="cotainer-fluid my-4">
        <h2 class="text-center">New Admin Registration</h2>
        <div class="row d-flex aliggn-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
        
                <form action="" method="post" enctype="multipart/form-data" class="user_form">
                    <!-- username feield -->
                    <div class="form-outline mb-4">
                        <label for="admin_name" class="form-label">Admin Name</label>
                        <input type="text" id="admin_name" class="form-control" placeholder="Enter Your Name" autocomplete="off" required="required" name="admin_name">
                    </div>
                    <!-- email feield -->
                    <div class="form-outline mb-4">
                        <label for="admin_email" class="form-label">E-mail</label>
                        <input type="email" id="admin_email" class="form-control" placeholder="Enter Your Email" autocomplete="off" required="required" name="admin_email">
                    </div>
                    <!-- image feield -->
                    <div class="form-outline mb-4">
                        <label for="admin_image" class="form-label">Image</label>
                        <input type="file" id="admin_image" class="form-control" required="required" name="admin_image">
                    </div>
                    <!-- password feield -->
                    <div class="form-outline mb-4">
                        <label for="admin_password" class="form-label">Password</label>
                        <input type="password" id="admin_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required="required" name="admin_password">
                    </div>
                    <!-- confirm password feield -->
                    <div class="form-outline mb-4">
                        <label for="conf_admin_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_admin_password" class="form-control" placeholder="Enter Your Confirm Password" autocomplete="off" required="required" name="conf_admin_password">
                    </div>
                    <!-- address feield -->
                    <div class="form-outline mb-4">
                        <label for="admin_address" class="form-label">Address</label>
                        <input type="text" id="admin_address" class="form-control" placeholder="Enter Your Address" autocomplete="off" required="required" name="admin_address">
                    </div>
                    <!-- contact feield -->
                    <div class="form-outline mb-4">
                        <label for="admin_contact" class="form-label">Contect</label>
                        <input type="text" id="admin_contact" class="form-control" placeholder="Enter Your Mobile Number" autocomplete="off" required="required" name="admin_contact">
                    </div>
                    <label for="TYPE" class="form-label">TYPE</label>
                    <select class="form-select" id="TYPE" name="TYPE" required="">
                        <option value="" selected="" disabled="">Enter Your Type</option>
                        <option value="	Admin">Admin</option>
                    </select>
                    <?php
                        if (isset($_POST['admin_register'])) {
                            $admin_name = trim($_POST['admin_name']);
                            $admin_email = trim($_POST['admin_email']);
                            $admin_password = trim($_POST['admin_password']);
                            $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
                            $conf_admin_password = trim($_POST['conf_admin_password']);
                            $admin_address = trim($_POST['admin_address']);
                            $admin_contact = trim($_POST['admin_contact']);
                            $admin_type = trim($_POST['TYPE']);
                            $admin_image = $_FILES['admin_image']['name'];
                            $admin_image_tmp = $_FILES['admin_image']['tmp_name'];
                        
                            $select_query = "SELECT * FROM `user_table` WHERE email='$admin_email'";
                            $result = mysqli_query($con, $select_query);
                            $rows_count = mysqli_num_rows($result);
                        
                            if ($rows_count > 0) {
                                echo "<script>alert('Email already exists')</script>";
                            } elseif ($admin_password != $conf_admin_password) {
                                echo "<script>alert('Passwords do not match')</script>";
                            } else {
                                move_uploaded_file($admin_image_tmp, "../admin/image/$admin_image");
                        
                                $insert_query = "INSERT INTO `user_table` (name, email, password, image, address, contact, type) 
                                                VALUES ('$admin_name', '$admin_email', '$hash_password', '$admin_image', '$admin_address', '$admin_contact', '$admin_type')";
                        
                                if (mysqli_query($con, $insert_query)) {
                                    echo "<div class='alert alert-success alert-dismissible' role='alert'>
                                            Registration Successfully
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                          </div>";
                                } else {
                                    echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
                                }
                            }
                        }
                        ?>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="admin_register">
                       
                    </div>
                </form>
            </div>
        </div>
    </div>


