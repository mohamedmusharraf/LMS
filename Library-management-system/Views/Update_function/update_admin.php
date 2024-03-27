<?php
include_once("../../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['editUserId']) && isset($_POST['editAdminName']) && isset($_POST['editAdminEmail']) && isset($_POST['editAdminAddress']) && isset($_POST['editAdminContact'])) {
        $userId = $con->real_escape_string($_POST['editUserId']);
        $name = $con->real_escape_string($_POST['editAdminName']);
        $email = $con->real_escape_string($_POST['editAdminEmail']);
        $address = $con->real_escape_string($_POST['editAdminAddress']);
        $contact = $con->real_escape_string($_POST['editAdminContact']);

        // Update query
        $query = "UPDATE admin_login 
                  SET admin_name = '$name', admin_email = '$email', 
                      admin_address = '$address', admin_contact = '$contact'
                  WHERE admin_id = '$userId'";

        if ($con->query($query) === TRUE) {
            echo json_encode(array('success' => 'Admin updated successfully'));
        } else {
            echo json_encode(array('error' => 'Error updating admin: ' . $con->error));
        }
    } else {
        echo json_encode(array('error' => 'Missing required fields'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}

$con->close();
?>
