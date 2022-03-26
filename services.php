<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
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
            <li><a href="#" style="background-color: #e1f4ee;">Our Services</a></li>
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
            <li><a href="caterers.php">Caterers</a></li>
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
    <section class="services">
        <div class="service">
            <img src="img/first.jpg" alt="Wedding catering">
            <div class="content">
                <h1>WEDDING CATERING</h1>
                <p>While we are all familiar with wedding catering, we can also agree that catering makes a huge impact on that special day. From the special guests to the bride and groom, you want to makes sure everyone eats (and celebrates) well. Decorations, dinner, dessert and what to drink along are just part of the planning.
                </p>
            </div>
        </div>
        <div class="service">
            <img src="img/second.jpg" alt="Corporate catering">
            <div class="content">
                <h1>CORPORATE CATERING</h1>
                <p>From small office meetings and trainings to large regional events, the ability to have great food delivered on site saves time & money while allowing you to focus on the more important task at hand, your business! Continental breakfasts, box lunches and buffets are all popular for corporate catering.
                </p>
            </div>
        </div>
        <div class="service">
            <img src="img/third.jpg" alt="Social Event catering">
            <div class="content">
                <h1>SOCIAL EVENT CATERING</h1>
                <p>When significant, life-changing events happen, family and friends gather together to offer support, encouragement, and well-wishes. If you are hosting one of these events in Park City, Vail, or Dallas, it is considered hospitable to provide food and drink to your guests, especially if it lasts for most of the day.
                </p>
            </div>
        </div>
        <div class="service">
            <img src="img/fourth.jpg" alt="Celebration Event catering">
            <div class="content">
                <h1>CELEBRATION EVENT CATERING</h1>
                <p>Any time that you can get together with family and friends is a time to celebrate. Food can express love, so feeding the people closest to you exquisite, unique dishes can express more than words. Furthermore, having the meal catered allows you to join in the festivities without having to worry about the logistics of the meal, which, though important to its success, can be an unwelcome distraction from special moments with your loved ones.
                </p>
            </div>
        </div>
    </section>
    <footer> <small>&copy; Copyright 2022, Caterer Reservation and Ordering System. All Rights Reserved</small> </footer> 
</body>

</html>