<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caterer Reports</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />    
    <script src="js/script.js"></script>
</head>

<body>
    <nav id="navbar">
        <div id="logo">
            <a href="index.php"><img src="img/logo.jpg" alt="Company Logo"></a>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="services.php">Our Services</a></li>
            <?php
                if(!isset($_SESSION['username'])) {
                ?>
                <li><a href="#" onclick="login_msg()">Schedule a Reservation</a></li>
                <li><a href="#" onclick="login_msg()">My Orders</a></li>
                <?php
                } else {
                    ?>
                    <li><a href="reservation.php">Schedule a Reservation</a></li>
                    <li><a href="orders.php">My Orders</a></li>
                    <?php
                }
                ?>
                <li><a href="#" style="background-color: #e1f4ee;">Caterers</a></li>
        </ul>
        <div id="right-box">
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <div class="user">
                    <div class="uname">
                        <?php
                        echo "<img style='width: 25px;' src='img/user.jpg'>";
                        echo "<a style='margin-top: 4px;'>" . strtoupper($_SESSION['username']) . "</a>";
                        ?>
                    </div>
                    <div class="logout-content">
                        <button style="margin-top: 4px;margin-right: 15px;border:none;font-size:16px;cursor:pointer" onclick="logout()">Log Out</button>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <button class="btn"><a href='login.php'>Log In</a></button>
                <button class="btn"><a href='user_registration.php'>Sign Up</a></button>
            <?php
            }
            ?>
        </div>
    </nav>
    <section class="caterers">
        <div class="caterer">
            <div class="img">
                <img src="img/vibe.webp">
            </div>
            <div class="caterer-info">
                <h3>Vibe Catering</h3>
                <p><img style="width: 15px;" src="img/location.png"> Chattarpur, Delhi NCR</p>
                <p>Starting Price (Veg Menu)</p>
                <h4>Rs.1,500 onwards</h4>
                <p>Vibe Catering is a catering company serving all over Faridabad. He started catering for wedding.</p>
                <button>Check Availability</button>
            </div>
        </div>
        <div class="caterer">

        </div>
        <div class="caterer">

        </div>
        <div class="caterer">

        </div>
    </section>
   
    <footer> <small>&copy; Copyright 2022, Caterer Reservation and Ordering System. All Rights Reserved</small> </footer> 
</body>

</html>