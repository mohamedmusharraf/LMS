<?php
include_once("../../connection/connect.php");

if (isset($_POST['message_id'])) {
    $messageId = $_POST['message_id'];

    $query = "DELETE FROM user_message WHERE id = ?";
    $stmt = $con->prepare($query);

    $stmt->bind_param("i", $messageId);

    if ($stmt->execute()) {
        echo "Message deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Message ID not provided.";
}
?>
