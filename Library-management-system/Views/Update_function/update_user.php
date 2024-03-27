<?php
include_once("../../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $con->real_escape_string($_POST['editUserId']);
    $userName = $con->real_escape_string($_POST['editUserName']);
    $userEmail = $con->real_escape_string($_POST['editUserEmail']);
    $userAddress = $con->real_escape_string($_POST['editUserAddress']);
    $userContact = $con->real_escape_string($_POST['editUserContact']);

    $query = "UPDATE user_table 
              SET name = '$userName', email = '$userEmail', 
                  address = '$userAddress', contact = '$userContact'
              WHERE id = $userId";

    if ($con->query($query) === TRUE) {
        echo json_encode(array('success' => 'User details updated successfully'));
    } else {
        echo json_encode(array('error' => 'Failed to update user details'));
    }
} else {
    echo json_encode(array('error' => 'Form data is not provided'));
}

$con->close();
?>
