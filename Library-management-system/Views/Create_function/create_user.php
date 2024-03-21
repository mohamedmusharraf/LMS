<?php
// Include the connection file
include_once("../../connection/connect.php");

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userName = $_POST["createUserName"] ?? "";
    $userEmail = $_POST["createUserEmail"] ?? "";
    $userImage = $_POST["createUserImage"] ?? "";
    $userPassword = $_POST["createUserPassword"] ?? "";
    $confUserPassword = $_POST["confUserPassword"] ?? "";
    $userAddress = $_POST["createUserAddress"] ?? "";
    $userContact = $_POST["createUserContact"] ?? "";

    // Validate the form data (You can add more validation logic here)
    if (empty($userName) || empty($userEmail)) {
        // Handle validation errors
        echo "Error: Name and Email are required fields.";
        exit;
    }

    // Prepare SQL statement to insert a new user into the database
    $stmt = $con->prepare("INSERT INTO `user_table` (user_name, user_email, user_image, user_password, user_address, user_contact) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssss", $userName, $userEmail, $userImage, $userPassword, $userAddress, $userContact);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Success message
        echo "User created successfully.";
    } else {
        // Error message
        echo "Error: Unable to create user.";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle non-POST requests
    echo "Error: Invalid request method.";
}
?>
