
<?php 
      include_once ("../Layouts/header2.php");
      require_once __DIR__ . '/../../models/recommendation.php';
      include_once ("../../connection/connect.php"); 
      require_once '../../helpers/AppManager.php';


      $userModel = new Book_Recommendation();
      $users = $userModel->getAll();

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
                                    <td><?= ++$key ?></td>
                                    <td><?= $c['book_title'] ?? ""; ?> </td>
                                    <td><?= $c['description'] ?? ""; ?> </td>
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
