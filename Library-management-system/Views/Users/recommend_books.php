<?php 
include_once("../Layouts/user_header.php");
include_once("../../connection/connect.php"); 

?>

<div class="col-xl">
    <div class="card mb-4 m-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Recommend a Book</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Book Title</label>
                    <input type="text" name="Book_Title" id="basic-default-phone" class="form-control phone-mask" placeholder="Enter Book Title..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-message">Description</label>
                    <textarea id="basic-default-message" name="Description" class="form-control" placeholder="Enter Description..." required></textarea>
                </div>
                <?php
                   // Check if the form is submitted
                   if(isset($_POST['submit'])) {
                   // Retrieve form data and sanitize it
                   $book_title = mysqli_real_escape_string($con, $_POST['Book_Title']);
                   $description = mysqli_real_escape_string($con, $_POST['Description']);
    
                   // Insert data into the database
                   $sql = "INSERT INTO `book_recommend` (book_title, description) 
                   VALUES ('$book_title', '$description')";
                   $login_query = mysqli_query($con, $sql);
    
                   if($login_query) {
                   echo "<div class='alert alert-success alert-dismissible' role='alert'>
                   Recommendation Sended
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                   </div>";
                   } else {
                   echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
                   }
                   }
                ?>
                <button type="submit" name="submit" class="btn btn-primary">Submit Recommendation</button>
            </form>
        </div>
    </div>
</div>
