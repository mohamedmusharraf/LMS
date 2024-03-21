
<?php 
      include_once ("../Layouts/header2.php") ;
      require_once __DIR__ . '/../../models/admin_send_message.php';
      include_once ("../../connection/connect.php"); 
      require_once '../../helpers/AppManager.php';
      require_once '../delete_function/delete_send_message.php';



      $userModel = new Admin_send_message();
      $users = $userModel->getAll();

?>
<!-- Get database Data -->
<div class="container">
    <div class="input-group input-group-merge mr-5 mt-3">
       <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
       <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
    </div>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="">#</th>
                                <th class="">NAME</th>
                                <th class="">Message</th>
                                <th class="">Date</th>
                                <th class="">Time</th>
                                <!-- <th style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
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
                                            <!-- Update the "Delete" button to include a data attribute for message ID -->
                                            <button class="btn btn-sm btn-danger m-2 delete-user" data-id="<?= $c['id'] ?>">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
    // Add event listener for the "Delete" button
    $('.delete-user').click(function() {
        // Get the message ID from the data attribute
        var messageId = $(this).data('id');
        
        // Confirm deletion with user
        if (confirm("Are you sure you want to delete this message?")) {
            // Send AJAX request to delete_message.php
            $.ajax({
                url: '../delete_function/delete_send_message.php',
                type: 'POST',
                data: {
                    message_id: messageId
                },
                success: function(response) {
                    // Reload the page or update the table as needed
                    location.reload(); // Reload the page for example
                },
                error: function(xhr, status, error) {
                    // Handle error if any
                    console.error(xhr.responseText);
                }
            });
        }
    });
});

</script>