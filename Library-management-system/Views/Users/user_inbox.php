<?php
// Include the database connection file
include_once("../../connection/connect.php");
include_once ("../Layouts/user_header.php");

$query = "SELECT * FROM admin_message";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $messages = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }
} else {
    $messages = array();
}
?>
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
        // Delete Function
        $(".delete-user").click(function() {
            var messageId = $(this).data("id");
            if (confirm("Are you sure you want to delete this message?")) {
                $.ajax({
                    url: "../delete_function/user_delete_inbox_message.php",
                    method: "POST",
                    data: { message_id: messageId },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
