<?php
include_once("../../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = $_POST["searchInput"];

    $query = "SELECT * FROM admin_login WHERE admin_name LIKE '%$keyword%' OR admin_email LIKE '%$keyword%'";

    $result = $con->query($query);

    if ($result) {
        $search_results = $result->fetch_all(MYSQLI_ASSOC);
        
        echo json_encode($search_results);
    } else {
        echo json_encode(array("error" => "Failed to retrieve search results"));
    }
} else {
    echo json_encode(array("error" => "Form not submitted"));
}
?>
