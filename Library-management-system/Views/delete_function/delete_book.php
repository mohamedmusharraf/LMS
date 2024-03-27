<?php
include_once("../../connection/connect.php");

if (isset($_POST['book_id']) && !empty($_POST['book_id'])) {
    $bookId = mysqli_real_escape_string($con, $_POST['book_id']);

    $query = "DELETE FROM add_books WHERE book_id = '$bookId'";

    if (mysqli_query($con, $query)) {
        echo "Book deleted successfully";
    } else {
        echo "Error deleting book: " . mysqli_error($con);
    }
} else {
    echo "Invalid book ID";
}
?>
