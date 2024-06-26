<?php 
include_once("../Layouts/header2.php");
include_once ("../../connection/connect.php"); 

$query = "SELECT * FROM user_table WHERE type = 'user'";
$result = $con->query($query);

if ($result) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $users = array(); 
    echo "Error: " . $con->error; 
}
?>
<!-- Get database Data -->
<form id="searchForm" class="d-flex m-5 mb-2">
    <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button id="searchButton" class="btn btn-outline-primary" type="submit">Search</button>
</form>
<section class="content m-3">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="">User id</th>
                            <th class="">Name</th>
                            <th class="">Email</th>
                            <th class="">Image</th>
                            <th class="">Address</th>
                            <th class="">Contact</th>
                            <th class="">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php foreach ($users as $key => $c) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $c['name'] ?? ""; ?> </td>
                            <td><?= $c['email'] ?? ""; ?> </td>
                            <td>
                                <?php if (!empty($c['image'])) { ?>
                                    <img src="../../views/users/images/<?= $c['image']; ?>" alt="User Image" width="80" height="50">
                                <?php } else { ?>
                                    No Image
                                <?php } ?>
                            </td>
                            <td><?= $c['address'] ?? ""; ?> </td>
                            <td><?= $c['contact'] ?? ""; ?></td>
                            <td>
                                <div>
                                    
                                    <button class="btn btn-sm btn-info m-2 edit-user" data-id="<?= isset($c['id']) ? $c['id'] : '' ?>">Edit</button>
                                    <button class="btn btn-sm btn-danger m-2 delete-user" data-id="<?= isset($c['id']) ? $c['id'] : '' ?>">Delete</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div style="text: center;">
                <button class="btn btn-sm btn-primary m-2 create-user" data-id="">Create</button>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <form id="editUserForm">
                    <input type="hidden" id="editUserId" name="editUserId">
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editUserName" name="editUserName">
                    </div>
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editUserEmail" name="editUserEmail">
                    </div>
                    <div class="mb-3">
                        <label for="editUserAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editUserAddress" name="editUserAddress">
                    </div>
                    <div class="mb-3">
                        <label for="editUserContact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="editUserContact" name="editUserContact">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2>Create User</h2>
                <form id="createUserForm" action="../Create_function/create_user.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="createUserName">Username:</label>
                        <input type="text" id="createUserName" name="createUserName" required><br><br>
                    </div>
                    <div class="mb-3">
                        <label for="createUserEmail">Email:</label>
                        <input type="email" id="createUserEmail" name="createUserEmail" required><br><br>
                    </div>
                    <div class="mb-3">
                        <label for="createUserImage">Profile Image:</label>
                        <input type="file" id="createUserImage" name="createUserImage"><br><br>
                    </div>
                    <div class="mb-3">
                        <label for="createUserPassword">Password:</label>
                        <input type="password" id="createUserPassword" name="createUserPassword" required><br><br>
                    </div>
                    <div class="mb-3">
                        <label for="confUserPassword">Confirm Password:</label>
                        <input type="password" id="confUserPassword" name="confUserPassword" required><br><br>
                    </div>
                    <div class="mb-3">
                        <label for="createUserAddress">Address:</label>
                        <textarea id="createUserAddress" name="createUserAddress"></textarea><br><br>
                    </div>
                    <div class="mb-3">
                        <label for="createUserContact">Contact:</label>
                        <input type="text" id="createUserContact" name="createUserContact"><br><br>
                    </div>
                    <div class="mb-3">
                        <label for="TYPE" class="form-label">Type</label>
                        <select class="form-select" id="TYPE" name="TYPE" required="">
                            <option value="" selected="" disabled="">Select User Type</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Get Form Details Function
    $(document).ready(function() {
    $(".edit-user").click(function() {
        var userId = $(this).data("id");
        $.ajax({
            url: "../get_details/get_user_details.php",
            method: "POST",
            data: { id: userId },
            dataType: "json",
            success: function(response) {
                // Populate form fields with user details
                $("#editUserId").val(response.id);
                $("#editUserName").val(response.name);
                $("#editUserEmail").val(response.email);
                $("#editUserAddress").val(response.address);
                $("#editUserContact").val(response.contact);
                // Show modal containing the form
                $('#editUserModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

   // Edit Function
$("#editUserForm").submit(function(event) {
    event.preventDefault(); 
    var formData = $(this).serialize();
    $.ajax({
        url: "../Update_function/update_user.php",
        method: "POST",
        data: formData,
        success: function(response) {
            var responseData = JSON.parse(response);
            if (responseData.success) {
                console.log(responseData.success);
                location.reload(); 
            } else {
                console.error(responseData.error);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});


    // Delete Fuction
    $(".delete-user").click(function() {
            var userId = $(this).data("id");
            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    url: "../Delete_function/delete_user.php",
                    method: "POST",
                    data: { id: userId },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });

        // Search Function
        $("#searchForm").submit(function(event) {
            event.preventDefault(); 
            var searchTerm = $("#searchInput").val(); 
            $.ajax({
            url: "../search_function/search_user.php", 
            method: "POST",
            data: { search_term: searchTerm }, 
            dataType: "html", 
            success: function(response) {
            $("tbody").html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});   
$(".create-user").click(function() {
    $('#createUserModal').modal('show');
        });
$("#createUserForm").submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData(this);

            $.ajax({
                url: "../Create_function/create_user.php",
                method: "POST",
                data: formData,
                processData: false, 
                contentType: false, 
                success: function(response) {
                    var responseData = JSON.parse(response);
                    if (responseData.success) {
                        console.log(responseData.success);
                        $('#createUserModal').modal('hide');
                        location.reload();
                    } else {
                        console.error(responseData.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        $(".create-user").click(function() {
            $('#createUserModal').modal('show');
        });
        $(".create-user").click(function() {
            $('#createUserModal').modal('show');
        });

        $("#createUserForm").submit(function(event) {
            event.preventDefault(); 

            var formData = new FormData(this);

            $.ajax({
                url: "../Create_function/create_user.php",
                method: "POST",
                data: formData,
                processData: false, 
                contentType: false, 
                success: function(response) {
                    var responseData = JSON.parse(response);
                    if (responseData.success) {
                        console.log(responseData.success);
                        $('#createUserModal').modal('hide');
                        location.reload();
                    } else {
                        console.error(responseData.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>