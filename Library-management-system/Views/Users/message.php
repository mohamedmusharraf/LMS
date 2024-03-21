<?php 
include_once("../Layouts/user_header.php");
include_once("../../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $message = $_POST['message'];

    $sql1 = "INSERT INTO `user_message` (name, message, date, Time) VALUES ('$name', '$message', CURDATE(), CURTIME())";

    if ($con->query($sql1) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Message Sending</div>";
    } else {
        echo "<script type='text/javascript'>alert('Error')</script>";
    }
} 
?>

<div class="col-xl">
    <div class="card mb-4 m-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Send a Message</h5>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Name</label>
                    <input type="text" name="name" id="basic-default-phone" class="form-control phone-mask" placeholder="Enter Name..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-message">Message</label>
                    <textarea id="basic-default-message" name="message" class="form-control" placeholder="Enter Message..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Message</button>
            </form>
        </div>
    </div>
</div>
