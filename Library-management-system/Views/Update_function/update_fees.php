<?php
include_once("../../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["book_id"]) && !empty($_POST["book_id"])) {
        $book_id = mysqli_real_escape_string($con, $_POST["book_id"]);

        $query = "UPDATE borrowed_books SET fees_status = 'Paid' WHERE book_id = $book_id";
        if (mysqli_query($con, $query)) {
            echo "Fees status updated successfully";
        } else {
            echo "Error updating fees status: " . mysqli_error($con);
        }
    } else {
        echo "Invalid book ID";
    }
} else {
    echo "Invalid request";
}
?>
