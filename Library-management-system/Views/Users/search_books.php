<?php
// Include necessary files
require_once "../../connection/connect.php";
require_once __DIR__ . '/../../models/User_currently_issue_books.php';
require_once '../../helpers/AppManager.php';

// Check if the search value is set in the POST request
if (isset($_POST['searchValue'])) {
    // Sanitize the search value to prevent SQL injection
    $searchValue = htmlspecialchars($_POST['searchValue']);

    // Initialize User_currently_issue_books model
    $userModel = new User_currently_issue_books();

    // Fetch filtered data from the database
    $filteredData = $userModel->searchBooks($searchValue);

    // Output the filtered data as HTML table rows
    if (!empty($filteredData)) {
        foreach ($filteredData as $key => $book) {
            echo "<tr>";
            echo "<td>" . ++$key . "</td>";
            echo "<td>" . $book['book_name'] . "</td>";
            echo "<td>" . $book['user_name'] . "</td>";
            echo "<td>" . $book['borrowed_date'] . "</td>";
            echo "<td>" . $book['return_date'] . "</td>";
            echo "<td>" . calculatePayment($book['borrowed_date'], $book['return_date']) . "</td>";
            echo "</tr>";
        }
    } else {
        // Output a message if no matching records found
        echo "<tr><td colspan='6'>No matching records found</td></tr>";
    }
} else {
    // Output an error message if search value is not set
    echo "Search value is missing";
}
?>