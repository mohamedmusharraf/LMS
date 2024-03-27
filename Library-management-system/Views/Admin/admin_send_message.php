<?php 
    include_once ("../Layouts/header2.php");
    include_once ("../../connection/connect.php");

  
    $sql = "SELECT * FROM admin_message";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                                <?php foreach ($users as $key => $c) { ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= $c['name'] ?? ""; ?> </td>
                                        <td><?= $c['message'] ?? ""; ?> </td>
                                        <td><?= $c['date'] ?? ""; ?> </td>
                                        <td><?= $c['time'] ?? ""; ?> </td>
                                        <td>
                                            <div>
                                                <button class="btn btn-sm btn-danger m-2 delete-user" data-id="<?= $c['id'] ?>">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
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
        // Delete Function
        $('.delete-user').click(function() {
            var messageId = $(this).data('id');
            
            if (confirm("Are you sure you want to delete this message?")) {
                $.ajax({
                    url: '../delete_function/delete_send_message.php',
                    type: 'POST',
                    data: {
                        message_id: messageId
                    },
                    success: function(response) {
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

<?php
    } else {
        echo "No records found";
    }

    mysqli_close($con);
?>
