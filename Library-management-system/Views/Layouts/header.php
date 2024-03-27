<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library management system</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../Assets/CSS/style.css">

    <script src="../../assets/vendor/js/helpers.js">
    </script>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.login-container {
    max-width: 300px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
}

h2 {
    text-align: center;
}

.form-group {
    margin-bottom: 20px;  
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="file"],
input[type="password"]{
    width: 50%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 20px;
    margin-bottom: 10px;
}
select{
    width: 50%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 20px;
    margin-bottom: 10px
}
button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}
.btn{
    width: 200px;
    height: 30px;
    background-color: #0056b3;
}
button:hover {
    background-color: #0056b3;
}
.user_form{
    text-align:center;
    align-items: center;   
}
    </style>
</head>
<body>
    <div id="background">
    <div id="header">
            <a href="#" class="fa fa-envelope" style="text-decoration:none;  color: white;">
                musharraf@gmail.com
              </a>
              <a href="#" class="fa fa-phone" style="text-decoration:none; color: white;">
                +94-722561061
              </a>
              <a href="#" class="fa fa-facebook" style="text-decoration:none; padding:7px; float:right; color: white;"></a>
              <a href="#" class="fa fa-instagram" style="text-decoration:none; padding:7px; float:right; color: white;"></a>
              <a href="#" class="fa fa-twitter" style="text-decoration:none;  padding: 7px ; float:right; color: white;"></a>
        </div>
        <div id="menu">
            <div id="logo">LIBRARY<b style="color:#2c7ad6 ;">ZONE</b>
            </div>
            <div id="menu1">
                <ul>
                    <a href="../Auth/login.php"><li class="fa fa-home">Home</li></a>
                    <!-- <a href="../Auth/user_login.php"><li class="fa fa-user">Users</li></a> -->
                    <a href="../registration/register.php"><li class="fa fa-registered">Register</li></a>  
                    <a href="../guest/all_books.php"><li class="fa fa-glide">Guest</li></a>  

                </ul>
            </div>   
        </div>
        