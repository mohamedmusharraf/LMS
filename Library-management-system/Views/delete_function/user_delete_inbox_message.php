<?php
include_once("../../connection/connect.php");

if (isset($_POST['message_id']) && !empty($_POST['message_id'])) {
    $messageId = mysqli_real_escape_string($con, $_POST['message_id']);

    $query = "DELETE FROM admin_message WHERE id = '$messageId'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "Message deleted successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Invalid message ID";
}
?>
