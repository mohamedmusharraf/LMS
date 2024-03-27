<?php
include_once("../../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editAdminId'], $_POST['editAdminName'], $_POST['editAdminEmail'], $_POST['editAdminAddress'], $_POST['editAdminContact'])) {
        $adminId = $_POST['editAdminId'];
        $adminName = $_POST['editAdminName'];
        $adminEmail = $_POST['editAdminEmail'];
        $adminAddress = $_POST['editAdminAddress'];
        $adminContact = $_POST['editAdminContact'];

        $query = "UPDATE admin_login 
                  SET admin_name = ?, admin_email = ?, admin_address = ?, admin_contact = ?
                  WHERE admin_id = ?";
        $stmt = $con->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssssi", $adminName, $adminEmail, $adminAddress, $adminContact, $adminId);
            if ($stmt->execute()) {
                echo json_encode(array('success' => 'User details updated successfully'));
            } else {
                echo json_encode(array('error' => 'Failed to update user details: ' . $stmt->error));
            }
            $stmt->close(); // Close the statement
        } else {
            echo json_encode(array('error' => 'Failed to prepare statement: ' . $con->error));
        }
    } else {
        echo json_encode(array('error' => 'Incomplete form data provided'));
    }
} else {
    echo json_encode(array('error' => 'Form data is not provided'));
}

$con->close();
?>
