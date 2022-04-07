<?php
session_start();
error_reporting(0);
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
    <?php
    include("config.php");
    $sql = $conn->query("SELECT DISTINCT c_name,location,c_status,c_phone,about,price,menu_type,occasion_type, filename FROM caterer_registration");
    $count = $sql->rowCount();
    if($count > 0) {

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { 
            $caterer = $row['c_name'];
            $sqlOrders = $conn->query("select count(c_name) as count,c_name, date from caterer_registration, reservation where caterer_registration.c_id = reservation.c_id and c_name = '$caterer';");

        ?>
        <div class="caterer">
            <div class="img">
                <img src="upload/<?php echo $row['filename'];?>">
            </div>
            <div class="caterer-info">
                <h3><?php echo ucwords($row['c_name'])."(".ucfirst($row['occasion_type']).")";?></h3>
                <p><img style="width: 17px;" src="img/location.png"> <?php echo $row['location'];?></p>
                <p>Starting Price (<?php echo ucfirst($row['menu_type']);?> Menu)</p>
                <h4>Rs.<?php echo $row['price'];?> onwards</h4>
                <p><?php echo $row['about'];?></p>
                <p><img style="width: 24px;" src="img/phone.png"><?php echo $row['c_phone'];?></p>
                <p style="font-weight: bold;">Total Orders Peding : <?php echo $sqlOrders->fetch(PDO::FETCH_ASSOC)['count'];?></p>
                <p id="status">Status : <?php echo ucfirst($row['c_status']);?></p>
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