<?php
include_once("../../connection/connect.php");

if(isset($_POST['id']) && !empty($_POST['id'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['id']);

    $query = "DELETE FROM user_table WHERE id = '$user_id'";
    
    if(mysqli_query($con, $query)) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Error: User ID is missing or invalid!";
}
?>
