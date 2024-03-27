<?php
require_once "../../connection/connect.php"; 
$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $search = $_GET["search"];

    $sql = "SELECT * FROM borrowed_books WHERE book_name LIKE ? OR user_name LIKE ?";

    $stmt = $con->prepare($sql);

    $searchParam = "%{$search}%";
    $stmt->bind_param("ss", $searchParam, $searchParam);

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }

    $result->close();

    $stmt->close();
}

$con->close();

echo json_encode($searchResults);
?>
