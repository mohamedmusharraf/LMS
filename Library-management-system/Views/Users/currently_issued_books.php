<?php 
    include_once ("../Layouts/user_header.php");
    include_once ("../../connection/connect.php");

    // Include database connection file
    include_once("../../connection/connect.php");
    
    // Query to fetch data from the borrowed_books table
    $query = "SELECT * FROM borrowed_books";
    $result = mysqli_query($con, $query);
    
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize an empty array to store borrowed books
        $borrowedBooks = array();
    
        // Fetch rows from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the borrowedBooks array
            $borrowedBooks[] = $row;
        }
    } else {
        // No borrowed books found
        $borrowedBooks = array();
    }
?>

<!-- Display borrowed books data -->
<div class="container">
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped" id="userData">
                        <thead>
                            <tr>
                                <th style="">Book id</th>
                                <th class="">Books NAME</th>
                                <th class="">USER NAME</th>
                                <th class="">BORROWED DATE</th>
                                <th class="">RETURN DATE</th>
                                <th class="">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($borrowedBooks as $key => $book) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $book['book_name'] ?? ""; ?></td>
                                    <td><?= $book['user_name'] ?? ""; ?></td>
                                    <td><?= $book['borrowed_date'] ?? ""; ?></td>
                                    <td><?= $book['return_date'] ?? ""; ?></td>
                                    <td><?= $book['status'] ?? ""; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
