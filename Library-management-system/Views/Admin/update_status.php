<?php
// update_status.php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the book_id and status are set in the POST data
    if (isset($_POST["book_id"]) && isset($_POST["status"])) {
        // Get the book_id and status from the POST data
        $book_id = $_POST["book_id"];
        $status = $_POST["status"];

        // Update the status of the book in the database
        updateBookStatus($book_id, $status);

        // Respond with a success message
        echo "Status updated successfully";
    } else {
        // Respond with an error message if book_id or status is not set in the POST data
        echo "Error: Book ID or status not provided";
    }
} else {
    // Respond with an error message if the request method is not POST
    echo "Error: Invalid request method";
}

// Function to update the status of the book in the database
function updateBookStatus($book_id, $status) {
    // Establish a connection to the database
    require_once "../../connection/connect.php";

    try {
        // Prepare an SQL statement to update the status of the book
        $stmt = $pdo->prepare("UPDATE borrowed_books SET status = :status WHERE book_id = :book_id");

        // Bind parameters and execute the statement
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error updating status: " . $e->getMessage();
    }
}
?>
