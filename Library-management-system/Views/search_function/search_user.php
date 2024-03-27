<?php
include_once("../../connection/connect.php");

if(isset($_POST['search_term']) && !empty($_POST['search_term'])) {
    $searchTerm = mysqli_real_escape_string($con, $_POST['search_term']);

    $query = "SELECT * FROM user_table WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
    $result = $con->query($query);

    if ($result) {
        $users = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($users as $key => $c) {
            echo "<tr>";
            echo "<td>".++$key."</td>";
            echo "<td>".$c['name']."</td>";
            echo "<td>".$c['email']."</td>";
            echo "<td>";
            if (!empty($c['image'])) {
                echo "<img src='../../views/users/images/".$c['image']."' alt='User Image' width='80' height='50'>";
            } else {
                echo "No Image";
            }
            echo "</td>";
            echo "<td>".$c['address']."</td>";
            echo "<td>".$c['contact']."</td>";
            echo "<td>";
            echo "<div>";
            echo "<button class='btn btn-sm btn-info m-2 edit-user' data-id='".(isset($c['id']) ? $c['id'] : '')."'>Edit</button>";
            echo "<button class='btn btn-sm btn-danger m-2 delete-user' data-id='".(isset($c['id']) ? $c['id'] : '')."'>Delete</button>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "Error: " . $con->error;
    }
} else {
    echo "Error: Search term is missing or invalid!";
}
?>
