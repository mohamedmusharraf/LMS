<?php 
    include_once ("../Layouts/header.php");
    include_once ("../../connection/connect.php");  
    
    session_start();

// Dummy admin credentials (replace these with your actual authentication mechanism)
$valid_username = "admin";
$valid_password = "admin123";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate username and password
    if ($username === $valid_username && $password === $valid_password) {
        // Authentication successful
        $_SESSION["admin_logged_in"] = true;
        header("Location: ../admin/home.php"); // Redirect to admin dashboard
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid username or password.";
    }
}
?>


    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Admin Name:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <?php if (isset($error_message)) { ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php } ?>
        </form>
    </div>

<?php 
    include_once ("../Layouts/footer.php");
    
   