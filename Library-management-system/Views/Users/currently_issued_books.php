<?php 
    include_once ("../Layouts/user_header.php");
    include_once ("../../connection/connect.php");
    
    $query = "SELECT * FROM borrowed_books";
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $borrowedBooks = array();
    
        while ($row = mysqli_fetch_assoc($result)) {
            $borrowedBooks[] = $row;
        }
    } else {
        $borrowedBooks = array();
    }
?>

<div class="container">
<form class="d-flex m-5 mb-2">
        <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="searchButton" class="btn btn-outline-primary" type="button">Search</button>
    </form>
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
<script>
    $(document).ready(function() {
        // Search Function
        $('#searchButton').click(function() {
            var searchQuery = $('#searchInput').val().toLowerCase();

            $('#userData tbody tr').each(function() {
                var found = false;
                $(this).find('td').each(function() {
                    var cellText = $(this).text().toLowerCase();
                    if (cellText.indexOf(searchQuery) !== -1) {
                        found = true;
                        return false; 
                    }
                });
                if (found) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
