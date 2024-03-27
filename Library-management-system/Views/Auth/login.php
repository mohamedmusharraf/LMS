<?php
session_start();
include_once("../Layouts/header.php");
include_once("../../connection/connect.php");

if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user_table WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
           echo"aaaaaaaaa";
            $_SESSION['id'] = $row['id'];
            $_SESSION['type'] = $row['type'];
            if ($row['type'] === 'Admin') {
                header("Location: ../Admin/home.php");
            } elseif ($_SESSION['type'] === 'User') {
                header("Location: ../users/home.php");
            }
        } else {
            echo '<script>alert("Incorrect password. Please try again.");</script>';
        }
    } else {
        echo '<script>alert("User does not exist. Please register.");</script>';
    }
}
?>


<div class="login-container">
    <form action="" method="post">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="submit" class="submit">Login</button>
    </form>
</div>
 
<?php
include_once("../Layouts/footer.php");  
?>
