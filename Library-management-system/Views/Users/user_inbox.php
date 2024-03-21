<?php
// Include the database connection file
include_once("../../connection/connect.php");
include_once ("../Layouts/user_header.php");

// Fetch data from the user_message table
$query = "SELECT * FROM admin_message";
$result = mysqli_query($con, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Initialize an empty array to store messages
    $messages = array();

    // Fetch rows from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each row to the messages array
        $messages[] = $row;
    }
} else {
    // No messages found
    $messages = array();
}
?>
<!-- HTML code to display the messages -->
<div class="container">
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Iterate over each message and display it in a row
                            foreach ($messages as $key => $message) { 
                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $message['name'] ?></td>
                                    <td><?= $message['message'] ?></td>
                                    <td><?= $message['date'] ?></td>
                                    <td><?= $message['time'] ?></td>
                                    <td>
                                        <div>
                                            <button class="btn btn-sm btn-danger m-2 delete-user" data-id="<?= $message['id'] ?>">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        $(".delete-user").click(function() {
            var messageId = $(this).data("id");
            // Confirm deletion
            if (confirm("Are you sure you want to delete this message?")) {
                // Send AJAX request to delete message
                $.ajax({
                    url: "../delete_function/user_delete_inbox_message.php",
                    method: "POST",
                    data: { message_id: messageId },
                    success: function(response) {
                        // Handle success (if needed)
                        console.log(response);
                        // Reload the page or update the table with the new data
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error (if needed)
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
