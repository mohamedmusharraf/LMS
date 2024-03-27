<?php 
    include_once ("../Layouts/header2.php");
    include_once ("../../connection/connect.php");

    $query = "SELECT *, TIMESTAMPDIFF(DAY, return_date, NOW()) AS days_late, CASE WHEN TIMESTAMPDIFF(DAY, return_date, NOW()) > 0 THEN TIMESTAMPDIFF(DAY, return_date, NOW()) * 50 ELSE 0 END AS fine FROM borrowed_books WHERE status != 'Returned' AND return_date < NOW()";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
?>
    <section class="content m-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                               <th>Book ID</th>
                               <th>Book Name</th>
                               <th>User Name</th>
                               <th>Borrowed Date</th>
                               <th>Return Date</th>
                               <th>Status</th>
                               <th>Fine</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            while($row = mysqli_fetch_assoc($result)) {
                        ?>
                               <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['book_name'] ?></td>
                                    <td><?= $row['user_name'] ?></td>
                                    <td><?= $row['borrowed_date'] ?></td>
                                    <td><?= $row['return_date'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['fine'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
    } else {
        echo "No records found where return date has passed and status is not 'Returned'.";
    }
    mysqli_close($con);
?>
