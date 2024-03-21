<?php
// Define getIPAddress function
function getIPAddress() {
    // Get IP address from REMOTE_ADDR server variable
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    } else {
        return 'UNKNOWN';
    }
}
     include_once ("../layouts/header.php") ;
     include_once ("../../connection/connect.php");
?>
<div class="cotainer-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex aliggn-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
        
                <form action="" method="post" enctype="multipart/form-data" class="user_form">
                    <!-- username feield -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter Your Username" autocomplete="off" required="required" name="user_username">
                    </div>
                    <!-- email feield -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">E-mail</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter Your Email" autocomplete="off" required="required" name="user_email">
                    </div>
                    <!-- image feield -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image </label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image">
                    </div>
                    <!-- password feield -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required="required" name="user_password">
                    </div>
                    <!-- confirm password feield -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Enter Your Confirm Password" autocomplete="off" required="required" name="conf_user_password">
                    </div>
                    <!-- address feield -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter Your Address" autocomplete="off" required="required" name="user_address">
                    </div>
                    <!-- contact feield -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contect</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter Your Mobile Number" autocomplete="off" required="required" name="user_contact">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account?<a href="../auth/user_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- php code -->
<?php
if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Select query to check if username or email already exists
    $select_query = "SELECT * FROM `user_table` WHERE user_name='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    
    // Check if username or email already exists
    if ($rows_count > 0) {
        echo "<script>alert('Username or Email already exists')</script>";
    } elseif ($user_password != $conf_user_password) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        // Move uploaded file to the destination directory
        move_uploaded_file($user_image_tmp, "../users/images/$user_image");

        // Insert query to add user to the database
        $insert_query = "INSERT INTO `user_table` (user_name, user_email, user_password, user_image, user_ip, user_address, user_contact) 
                         VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        
        // Execute the insert query
        if (mysqli_query($con, $insert_query)) {
            echo "<script>alert('User registered successfully')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
        }
    }
}
      
     include_once ("../layouts/footer.php") ;
?>