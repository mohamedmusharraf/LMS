<?php 
include_once ("../Layouts/header2.php");
include_once ("../../connection/connect.php");

$query = "SELECT * FROM borrowed_books WHERE status = 'Returned'";
$result = mysqli_query($con, $query);

?>

<!-- Display borrowed books data -->
<div class="container">
    <form class="d-flex m-5 mb-2" id="searchForm">
        <input id="searchInput" name="searchValue" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="searchButton" class="btn btn-outline-primary" type="submit">Search</button>
    </form>
</div>
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
                                <th class="">AMOUNT</th>
                                <th class="">STATUS</th>
                                <th class="">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            if (mysqli_num_rows($result) > 0) {
                                while ($book = mysqli_fetch_assoc($result)) { 
                                    $borrowedDate = strtotime($book['borrowed_date']);
                                    $returnDate = strtotime($book['return_date']);
                                    $difference = $returnDate - $borrowedDate;
                                    $days = round($difference / (60 * 60 * 24));
                                    $amount = $days * 100; 
                                    ?>
                                    <tr>
                                        <td><?= $book['id'] ?></td>
                                        <td><?= $book['book_name'] ?? ""; ?></td>
                                        <td><?= $book['user_name'] ?? ""; ?></td>
                                        <td><?= $book['borrowed_date'] ?? ""; ?></td>
                                        <td><?= $book['return_date'] ?? ""; ?></td>
                                        <td><?= $amount ?></td> 
                                        <td><?= $book['action'] ?? ""; ?></td>
                                        <td>
                                            <div>
                                               <button class='btn btn-sm btn-primary m-2 edit-book' data-id="<?= $book['id'] ?>">PAY</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="6">No records found</td>
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
        // Update Function
        $('.edit-book').click(function() {
            var returnBookId = $(this).data('id');
            var actionColumn = $(this).closest('tr').find('td').eq(6); 
            $.ajax({
                url: '../Update_function/update_action.php', 
                method: 'POST',
                data: { return_book_id: returnBookId },
                success: function(response) {
                    if (response === "success") {
                        actionColumn.text('Paid').css('color', 'green'); 
                    } else {
                        alert('Failed to update action.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error updating action:", error);
                }
            });
        });
        // Search Function
        $('#searchForm').submit(function(event) {
        event.preventDefault(); 
        
        var searchValue = $('#searchInput').val();
             
        $.ajax({
            url: '../search_function/search_payments.php', 
            method: 'POST',
            data: { searchValue: searchValue },
            success: function(response) {
                $('#userData tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching filtered data:", error);
            }
        });
    });

        function updateTable(data) {
            var tableBody = $('#userData tbody');
            tableBody.empty(); 

            if(data.length > 0) {
                $.each(data, function(index, book) {
                  
                });
            } else {
                tableBody.append('<tr><td colspan="8">No records found</td></tr>');
            }
        }
    });
</script>
<?php include_once ("../Layouts/footer2.php"); ?>
