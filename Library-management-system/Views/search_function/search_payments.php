<?php
include_once("../../connection/connect.php");

if(isset($_POST['searchValue'])) {
    $searchValue = mysqli_real_escape_string($con, $_POST['searchValue']);

    $query = "SELECT * FROM borrowed_books WHERE status = 'Returned' AND (book_name LIKE '%$searchValue%' OR user_name LIKE '%$searchValue%')";
    $result = mysqli_query($con, $query);

    $filteredDataHTML = '';

    if(mysqli_num_rows($result) > 0) {
        while($book = mysqli_fetch_assoc($result)) {
            $filteredDataHTML .= "<tr>";
            $filteredDataHTML .= "<td>{$book['id']}</td>";
            $filteredDataHTML .= "<td>{$book['book_name']}</td>";
            $filteredDataHTML .= "<td>{$book['user_name']}</td>";
            $filteredDataHTML .= "<td>{$book['borrowed_date']}</td>";
            $filteredDataHTML .= "<td>{$book['return_date']}</td>";
            $filteredDataHTML .= "<td>{$book['status']}</td>";
            $filteredDataHTML .= "<td>";
            if($book['status'] !== 'Returned') {
                $filteredDataHTML .= "<button class='btn btn-sm btn-info m-2 edit-book' data-id='{$book['id']}'>Return</button>";
            } else {
                $filteredDataHTML .= "<button class='btn btn-sm btn-info m-2' disabled>Returned</button>";
            }
            $filteredDataHTML .= "</td>";
            $filteredDataHTML .= "</tr>";
        }
    } else {
        $filteredDataHTML = "<tr><td colspan='7'>No records found</td></tr>";
    }

    echo $filteredDataHTML;
} else {
    echo "error";
}
?>
