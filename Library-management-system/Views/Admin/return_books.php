<?php 
    include_once("../../connection/connect.php");

    function increaseQuantity($bookName) {
        global $con;
        $query = "UPDATE add_books SET number_of_copies = number_of_copies + 1 WHERE book_title = '$bookName'";
        mysqli_query($con, $query);
    }

    if (isset($_POST['return_book_id'])) {
        $returnBookId = $_POST['return_book_id'];
        
        $returnQuery = "UPDATE borrowed_books SET status = 'Returned' WHERE id = $returnBookId";
        mysqli_query($con, $returnQuery);

        $bookQuery = "SELECT book_name FROM borrowed_books WHERE id = $returnBookId";
        $bookResult = mysqli_query($con, $bookQuery);
        $bookData = mysqli_fetch_assoc($bookResult);
        $bookName = $bookData['book_name'];

        increaseQuantity($bookName);

        echo "success";
        exit;
    }
?>
