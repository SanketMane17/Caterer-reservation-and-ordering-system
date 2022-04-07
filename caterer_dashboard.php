<?php
session_start();
error_reporting(0);
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caterer Dashboard</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <script src="js/script.js"></script>
</head>

<body>
    <nav id="navbar">
        <div id="logo">
            <img src="img/logo.jpg" alt="Company Logo">
        </div>
        <ul>
        <li><a href="#" style="background-color: #e1f4ee;">Dashboard</a></li>
        </ul>
        <div id="right-box">
        <div class="user">
            <div class="logout-content">
                <a href="index.php"><button style="margin-top: 4px;margin-right: 15px;border:none;font-size:18px;cursor:pointer" onclick="logout()">Log Out</button></a>
            </div>
        </div>
        </div>
    </nav>
    <section class="home">
            
    </section>
    
</body>

</html>