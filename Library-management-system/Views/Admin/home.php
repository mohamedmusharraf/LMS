<?php 
include_once("../Layouts/header2.php");
include_once("../../connection/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
.library-news {
    background-color: #f8f9fa; 
    padding: 50px 0; 
}

.library-news .container {
    text-align: center;
}

.library-news h2 {
    margin-bottom: 30px;
}

.library-news .news {
    display: flex;
    justify-content: center;
}

.library-news .news-item {
    width: 100%;
    max-width: 600px;
    background-color: #fff;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
}

.library-news .news-item h3 {
    margin-bottom: 10px;
    font-size: 1.5em;
}

.library-news .news-item p {
    margin-bottom: 20px;
}

.library-news .news-item .read-more {
    display: inline-block;
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 3px;
    transition: background-color 0.3s ease;
}

.library-news .news-item .read-more:hover {
    background-color: #0056b3; 
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 500px;
    top: 100px;
    width: 50%;
    height: 80%;
    background-color: rgba(0,0,0,0.5); 
    overflow: auto;
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    border-radius: 10px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library News & Updates</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Library News/Updates Section -->
<section class="library-news">
    <div class="container">
        <h2>Library News & Updates</h2>
        <div class="news">
            <div class="news-item">
                <h3>Upcoming Events</h3>
                <ul>
                    <li>
                        <h4>Book Club Meeting</h4>
                        <p>Date: April 10, 2024</p>
                        <p>Time: 5:00 PM - 6:00 PM</p>
                        <p>Location: Library Meeting Room</p>
                        <a href="#" class="read-more">Read More</a>
                    </li>
                    <li>
                        <h4>Author Talk: Jane Doe</h4>
                        <p>Date: April 15, 2024</p>
                        <p>Time: 6:30 PM - 7:30 PM</p>
                        <p>Location: Library Auditorium</p>
                        <a href="#" class="read-more">Read More</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div id="event-details-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Book Club Meeting</h2>
        <p>Date: April 10, 2024</p>
        <p>Time: 5:00 PM - 6:00 PM</p>
        <p>Location: Library Meeting Room</p>
        <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et nisi a nunc ultricies rhoncus.</p>
    </div>
</div>

</body>
</html>
<script>
var modal = document.getElementById("event-details-modal");

var span = document.getElementsByClassName("close")[0];

var readMoreButtons = document.querySelectorAll(".read-more");
readMoreButtons.forEach(function(button) {
    button.onclick = function() {
        modal.style.display = "block";
    }
});

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>