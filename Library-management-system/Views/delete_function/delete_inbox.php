<?php
require_once "../../connection/connect.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message_id"])) {
    $messageId = $_POST["message_id"];

    $sql = "DELETE FROM user_message WHERE id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $messageId);

    if ($stmt->execute()) {
        echo "Message deleted successfully.";
    } else {
        echo "Error deleting message.";
    }

    $stmt->close();
}

$con->close();
?>
