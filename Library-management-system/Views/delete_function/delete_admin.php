<?php
include_once("../../connection/connect.php");

if (isset($_POST['admin_id'])) {
    $adminId = $_POST['admin_id'];

    $query = "DELETE FROM admin_login WHERE admin_id = ?";
    $stmt = $con->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $adminId);
        if ($stmt->execute()) {
            echo json_encode(array('success' => 'Admin data deleted successfully'));
        } else {
            echo json_encode(array('error' => 'Failed to delete admin data: ' . $stmt->error));
        }
        $stmt->close();
    } else {
        echo json_encode(array('error' => 'Failed to prepare statement: ' . $con->error));
    }
} else {
    echo json_encode(array('error' => 'Admin ID is not provided'));
}

$con->close();
?>
