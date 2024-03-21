<?php 
// Include header file
include_once ("../Layouts/header2.php");

// Include connection file
include_once ("../../connection/connect.php");

// Query to fetch data from the borrowed_books table where return date has passed and status is not 'Returned'
$query = "SELECT *, TIMESTAMPDIFF(DAY, return_date, NOW()) AS days_late, CASE WHEN TIMESTAMPDIFF(DAY, return_date, NOW()) > 0 THEN TIMESTAMPDIFF(DAY, return_date, NOW()) * 50 ELSE 0 END AS fine FROM borrowed_books WHERE status != 'Returned' AND return_date < NOW()";
$result = mysqli_query($con, $query);

// Check if there are any rows returned
if(mysqli_num_rows($result) > 0) {
    echo "<table border='1' class='m-4'>";
    echo "<tr><th>Book ID</th><th>Book Name</th><th>User Name</th><th>Borrowed Date</th><th>Return Date</th><th>Status</th><th>Fine</th></tr>";
    // Fetch rows from the result set
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['book_name']."</td>";
        echo "<td>".$row['user_name']."</td>";
        echo "<td>".$row['borrowed_date']."</td>";
        echo "<td>".$row['return_date']."</td>";
        echo "<td>".$row['status']."</td>";
        echo "<td>".$row['fine']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // No rows found
    echo "No records found where return date has passed and status is not 'Returned'.";
}
?>
