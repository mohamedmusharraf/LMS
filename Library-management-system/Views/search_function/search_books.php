<?php
include_once("../../connection/connect.php");

if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
    $searchQuery = mysqli_real_escape_string($con, $_POST['search_query']);

    $query = "SELECT * FROM add_books WHERE book_title LIKE '%$searchQuery%'";

    $result = mysqli_query($con, $query);

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($books);
} else {
    echo json_encode([]);
}
?>
