<?php
include_once("../../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookId = $_POST["editBookId"];
    $bookTitle = $_POST["editBookTitle"];
    $author = $_POST["editBookAuthor"];
    $publisher = $_POST["editBookPublisher"];
    $year = $_POST["editBookYear"];
    $availability = $_POST["editBookAvailability"];

    $query = "UPDATE add_books SET book_title = ?, author = ?, publisher = ?, year = ?, number_of_copies = ? WHERE book_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssii", $bookTitle, $author, $publisher, $year, $availability, $bookId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Book details updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating book details: " . $con->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

$con->close();
?>
