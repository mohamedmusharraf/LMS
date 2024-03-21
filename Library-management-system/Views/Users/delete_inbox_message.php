<?php
// Debugging: Log request method
error_log("Request Method: " . $_SERVER["REQUEST_METHOD"]);

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Log POST data
    error_log("POST Data: " . print_r($_POST, true));

    // Check if the 'id' parameter is set
    if (isset($_POST['id'])) {
        // Sanitize the input to prevent SQL injection
        $messageId = htmlspecialchars($_POST['id']);

        // Debugging: Log sanitized message ID
        error_log("Sanitized Message ID: " . $messageId);

        // Include necessary files and initialize any required classes
        require_once "../../connection/connect.php"; // Include your database connection file
        require_once __DIR__ . '/../../models/user_inbox.php'; // Include your User_inbox model

        // Create an instance of the User_inbox model
        $userModel = new User_inbox();

        // Delete the message with the specified ID
        $result = $userModel->deleteMessage($messageId);

        // Check if the deletion was successful
        if ($result) {
            // Return success message
            echo "Message deleted successfully";
        } else {
            // Return error message
            echo "Error deleting message";
        }
    } else {
        // Return error message if 'id' parameter is not set
        echo "ID parameter is missing";
    }
} else {
    // Return error message if request method is not POST
    echo "Invalid request method";
}
?>
