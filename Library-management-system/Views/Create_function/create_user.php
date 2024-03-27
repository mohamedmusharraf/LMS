<?php
include_once("../../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['createUserName'];
    $email = $_POST['createUserEmail'];
    $password = $_POST['createUserPassword'];
    $confirmPassword = $_POST['confUserPassword'];
    $address = $_POST['createUserAddress'];
    $contact = $_POST['createUserContact'];
    $type = $_POST['TYPE'];

    if ($password !== $confirmPassword) {
        echo json_encode(array("error" => "Passwords do not match."));
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $image = "";
    if ($_FILES['createUserImage']['error'] === UPLOAD_ERR_OK) {
        $imageDir = "../../views/users/images/";
        $imageName = uniqid() . "_" . $_FILES['createUserImage']['name'];
        $targetFile = $imageDir . $imageName;

        if (move_uploaded_file($_FILES['createUserImage']['tmp_name'], $targetFile)) {
            $image = $imageName;
        } else {
            echo json_encode(array("error" => "Failed to upload image."));
            exit();
        }
    }

    $query = "INSERT INTO user_table (name, email, password, image, address, contact, type) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssssss", $username, $email, $hashedPassword, $image, $address, $contact, $type);

    if ($stmt->execute()) {
        echo json_encode(array("success" => "User created successfully."));
    } else {
        echo json_encode(array("error" => "Error creating user: " . $con->error));
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(array("error" => "Invalid request method."));
}
?>
