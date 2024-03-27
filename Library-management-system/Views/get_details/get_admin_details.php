<?php
include_once("../../connection/connect.php");

if (isset($_POST['admin_id'])) {
    $adminId = $con->real_escape_string($_POST['admin_id']);

    $query = "SELECT * FROM admin_login WHERE admin_id = $adminId";
    $result = $con->query($query);

    if ($result) {
        $adminDetails = $result->fetch_assoc();

        echo json_encode($adminDetails);
    } else {
        echo json_encode(array('error' => 'Failed to fetch user details'));
    }
} else {
    echo json_encode(array('error' => 'User ID is not provided'));
}

$con->close();
?>
