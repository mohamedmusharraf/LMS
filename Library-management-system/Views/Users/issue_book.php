<?php
session_start();
include_once("../../connection/connect.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id, book_id, and book_name are set in the POST data
    if (isset($_POST['user_id']) && isset($_POST['book_id']) && isset($_POST['book_name'])) {
        // Sanitize the input data
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
        $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);

        // Prepare and execute the SQL query to insert data into issue_request table
        $sql = "INSERT INTO `issue_request` (user_id, book_id, book_name, availability) VALUES ('$user_id', '$book_id', '$book_name', 'unavailable')";
        if (mysqli_query($conn, $sql)) {
            // Return success response
            echo "success";
        } else {
            // Return error response
            echo "error";
        }
    } else {
        // Return error response if any of the required fields are missing
        echo "error";
    }
} else {
    // Return error response if the request method is not POST
    echo "error";
}
?>
