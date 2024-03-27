<?php
include_once("../../connection/connect.php");

if(isset($_POST['return_book_id'])) {
    $returnBookId = mysqli_real_escape_string($con, $_POST['return_book_id']);

    $updateQuery = "UPDATE borrowed_books SET action = 'Paid' WHERE id = '$returnBookId'";
    if(mysqli_query($con, $updateQuery)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
