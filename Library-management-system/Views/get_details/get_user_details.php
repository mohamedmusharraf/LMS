<?php
include_once("../../connection/connect.php");

if (isset($_POST['id'])) {
    $userId = $con->real_escape_string($_POST['id']);

    $query = "SELECT * FROM user_table WHERE id = $userId";
    $result = $con->query($query);

    if ($result) {
        $userDetails = $result->fetch_assoc();

        echo json_encode($userDetails);
    } else {
        echo json_encode(array('error' => 'Failed to fetch user details'));
    }
} else {
    echo json_encode(array('error' => 'User ID is not provided'));
}

$con->close();
?>
