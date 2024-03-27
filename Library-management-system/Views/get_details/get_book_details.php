<?php

if (isset($_POST['book_id'])) {

    require_once '../../connection/connect.php';

    $bookId = $_POST['book_id'];
    $query = "SELECT * FROM add_books WHERE book_id = ?";
    $statement = $con->prepare($query);
    $statement->bind_param('i', $bookId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $bookDetails = $result->fetch_assoc();
        
        header('Content-Type: application/json');
        echo json_encode($bookDetails);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(array('error' => 'Book not found'));
    }

    $statement->close();
    $con->close();
} else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(array('error' => 'Book ID is required'));
}
?>
