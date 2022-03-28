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
    <script>
        function showAvailabilty(cid) {
            <?php
                include "config.php";
                $sqlDate = $conn->query("SELECT date FROM reservation, caterer_registration WHERE reservation.c_id = caterer_registration.c_id AND reservation.c_id = '3'");

                if($sqlDate->rowCount() > 0) {
                    ?>
                    alert("Enguaged");
                    <?php
                }
                else {
                    ?>
                    alert("Available");
                    <?php
                }
            ?>
        }
    </script>
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
    <?php
    include("config.php");
    $sql = $conn->query("SELECT * FROM caterer_registration");
    $count = $sql->rowCount();
    if($count > 0) {

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { 
        ?>
        <div class="caterer">
            <div class="img">
                <img src="upload/<?php echo $row['filename'];?>">
            </div>
            <div class="caterer-info">
                <h3><?php echo ucwords($row['c_name']);?></h3>
                <p><img style="width: 17px;" src="img/location.png"> <?php echo $row['location'];?></p>
                <p>Starting Price (<?php echo ucfirst($row['menu_type']);?> Menu)</p>
                <h4>Rs.<?php echo $row['price'];?> onwards</h4>
                <p><?php echo $row['about'];?></p>
                <p><img style="width: 24px;" src="img/phone.png"><?php echo $row['c_phone'];?></p>
                <button onclick="showAvailabilty(<?php echo $row['c_id'];?>)">Check Availability</button>
            </div>
        </div>
        <?php
        }
    }
        ?>
    </section>
   
    <footer> <small>&copy; Copyright 2022, Caterer Reservation and Ordering System. All Rights Reserved</small> </footer> 
</body>

</html>