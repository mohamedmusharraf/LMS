<?php 
    // Include header file
    include_once("../Layouts/user_header.php");
    
    // Include database connection file
    include_once("../../connection/connect.php");
    
    // Query to fetch data from the user_message table
    $query = "SELECT * FROM user_message";
    $result = mysqli_query($con, $query);
    
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize an empty array to store messages
        $users = array();
    
        // Fetch rows from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the users array
            $users[] = $row;
        }
    } else {
        // No messages found
        $users = array();
    }
?>

<div class="container">
    <div class="input-group input-group-merge mr-5 mt-3">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
    </div>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="">#</th>
                                <th class="">NAME</th>
                                <th class="">Message</th>
                                <th class="">Date</th>
                                <th class="">Time</th>
                                <th style="width: 200px">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Check if $users is not null and is an array
                            if (!empty($users) && is_array($users)) {
                                foreach ($users as $key => $c) { 
                            ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $c['name'] ?? ""; ?> </td>
                                    <td><?= $c['message'] ?? ""; ?> </td>
                                    <td><?= $c['date'] ?? ""; ?> </td>
                                    <td><?= $c['time'] ?? ""; ?> </td>
                                    <td>
                                        <div>
                                        <button class="btn btn-sm btn-danger m-2 delete-user" data-id="<?= $c['id'] ?>" onclick="deleteUser(<?= $c['id'] ?>)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                                } 
                            } else {
                                echo "<tr><td colspan='6'>No messages found</td></tr>";
                            }
                            ?>
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
                    url: "../delete_function/delete_user_sending_message.php",
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