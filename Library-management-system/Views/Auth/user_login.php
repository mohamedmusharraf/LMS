<?php 
    include_once("../Layouts/header.php");
    include_once("../../connection/connect.php");

    function getIPAddress() {
        // Get IP address from REMOTE_ADDR server variable
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return 'UNKNOWN';
        }
    }
?>

<div class="login-container">
    <h2>User Login</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="user_password">Password:</label>
            <input type="password" id="user_password" name="user_password" required>
        </div>
        <button type="submit" name="submit" class="submit">Login</button>
    </form>
</div>

<?php 
if(isset($_POST['submit'])){
    $user_email = $_POST['email']; // Corrected variable name
    $user_password = $_POST['user_password']; // Corrected variable name

    if(!empty($user_email) && !empty($user_password) && !is_numeric($user_email))
    {
        // Hash the password entered by the user
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM `user_table` WHERE user_email = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);

            // Verify hashed password
            if(password_verify($user_password, $user_data['user_password']))
            {
                header("location: ../users/home.php");
                exit;
            }
        }
        echo "<script>alert('Wrong Username or Password')</script>";
    }
    else {
        echo "<script>alert('Wrong Username or Password')</script>";
    }
}

include_once("../Layouts/footer.php");
?>
