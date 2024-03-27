<?php
require_once "../../connection/connect.php"; 

if (isset($_GET['book_id']) && !empty($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    $stmt = $con->prepare("SELECT * FROM add_books WHERE book_id = ?");
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();

        echo json_encode($book);
    } else {
        echo json_encode(array("error" => "Book not found!"));
    }
    
    $stmt->close();
} else {

}


?>
