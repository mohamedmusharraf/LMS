<?php 
    include_once("../Layouts/header2.php");
    include_once("../../connection/connect.php");

    $sql = "SELECT * FROM book_recommend";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC); 
?>
        <!-- Get database Data -->
        <section class="content m-3">
            <div class="container-fluid">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="">Book id</th>
                                    <th class="">Books NAME</th>
                                    <th class="">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($users as $key => $c) {
                            ?>
                                    <tr>
                                        <td><?= $c['id']; ?></td>
                                        <td><?= $c['book_title']; ?></td>
                                        <td><?= $c['description']; ?></td>
                                    </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
    } else {
        echo "No records found";
    }

    mysqli_close($con);
?>
