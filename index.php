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
    <title>Catering Services</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <script src="js/script.js"></script>
    </script>
</head>

<body>
    <nav id="navbar">
        <div id="logo">
            <a href="index.php"><img src="img/logo.jpg" alt="Company Logo"></a>
        </div>
        <ul>
            <?php
            if ($_SESSION['username'] === "admin") {
            ?>
                <li style="background-color: #e1f4ee;"><a style="cursor: pointer;padding: 19px 15px;">Received Orders</a></li>
                <li><a href="reports.php" style="cursor: pointer;">Reports</a></li>
            <?php
            } else {
            ?>
                <li style="background-color: #e1f4ee;"><a href="#">Home</a></li>
                <li><a href="services.php">Our Services</a></li>
                <?php
                if (!isset($_SESSION['username'])) {
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
            <?php
            }
            ?>
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
    <?php
    if ($_SESSION['username'] !== "admin") {
    ?>
        <section class="home">
            <div class="container-1">
                <div class="intro">
                    <h1>Catering</h1>
                    <p>Please call at least 24 hours in advance for catering orders.</p>
                </div>
                <div class="sections">
                    <div class="section">
                        <img src="img/salad.jpg" alt="Salad">
                        <p>Fresh Salads.</p>
                    </div>
                    <div class="section">
                        <img src="img/party.jpg" alt="Party Platters">
                        <p>Party Platters.</p>
                    </div>
                    <div class="section">
                        <img src="img/sea.jpg" alt="Sea Food">
                        <p>Sea Food.</p>
                    </div>
                    <div class="section">
                        <img src="img/veggan.jpg" alt="Veggan Desserts">
                        <p>Veggan Desserts.</p>
                    </div>
                </div>
                <div class="order-btn">
                    <?php
                    if (!isset($_SESSION['username'])) {
                    ?>
                        <a href="caterer_registration.php"><button class="schedule-btn" style="width: 138px;margin-left: 10px;">Caterer Registration</button></a>
                    <?php
                    } else {
                    ?>
                        <a href="reservation.php"><button class="schedule-btn">Schedule Now</button></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <section class="about">
            <div class="container-2">
                <div>
                    <h1>About Us</h1>
                </div>
                <div class="about-box">
                    <div class="about-content">
                        <p>Catering is the business of providing food service at a remote site or a site such as a hotel, hospital, pub, aircraft, cruise ship, park, filming site or studio, entertainment site, or event venue.
                        </p>
                        <p>As a full-service event catering company, Eco Caters works hard to execute the unique vision for each of our clients'. Collaboratively, we custom design everything from the menus to budgets, decor to the cocktail list, and much more. We aim to satisfy all the senses — sight, sound, touch, taste, smell. Continuity is key to create the perfect ambience.</p>
                        <p>A good catering team will pick up all dirty plates, unattended drinks, sweep up broken glass, and even deep clean the venue at the end of the night to help you get your deposit back. This dedication keeps the event safe and looking flawless at all times. If all goes well, you won't even be aware of all the behind the scenes care a catering team, and their servers, put into your event.</p>
                    </div>
                    <div class="about-img">
                        <img src="img/about.jpg" alt="About Us Image">
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    else {
    ?>
    <section class="admin" style="background-color: white;">
        <div class="myorders">
            <?php
            include("config.php");
            $status = 'confirmed';
            $sql = $conn->query("SELECT * FROM reservation");
            $count = $sql->rowCount();
            if ($count > 0) {

                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <table class="myorder">
                        <tr>
                            <th id="order-id" colspan="2">Order Id #<?php echo $row['r_id'] ?></th>
                        </tr>
                        <tr>
                            <th>First Name : </th>
                            <td><?php echo $row['fname']; ?></td>
                        </tr>
                        <tr>
                            <th>Last Name : </th>
                            <td><?php echo $row['lname']; ?></td>
                        </tr>
                        <tr>
                            <th>Address : </th>
                            <td><?php echo $row['address']; ?></td>
                        </tr>
                        <tr>
                            <th>Contact : </th>
                            <td><?php echo $row['contact']; ?></td>
                        </tr>
                        <tr>
                            <th>Email : </th>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <th>Venue : </th>
                            <td><?php echo $row['venue']; ?></td>
                        </tr>
                        <tr>
                            <th>Date of Event : </th>
                            <td><?php echo $row['date']; ?></td>
                        </tr>
                        <tr>
                            <th>Time of Event : </th>
                            <td><?php echo $row['time']; ?></td>
                        </tr>
                        <tr>
                            <th>Occasion : </th>
                            <td><?php echo $row['occasion']; ?></td>
                        </tr>
                        <tr>
                            <th>Menu : </th>
                            <td><?php echo $row['menu']; ?></td>
                        </tr>
                        <tr>
                            <th>Type of Service : </th>
                            <td><?php echo $row['service']; ?></td>
                        </tr>
                        <tr>
                            <th>People Count : </th>
                            <td><?php echo $row['peoplecount']; ?></td>
                        </tr>
                        <tr>
                            <th>Budget : </th>
                            <td><?php echo $row['budget']; ?></td>
                        </tr>
                        <tr>
                            <th>By User : </th>
                            <td><?php echo $row['uname']; ?></td>
                        </tr>
                        <tr>
                            <th>By Caterer : </th>
                            <td><?php echo $row['caterer']; ?></td>
                        </tr>
                        <tr>
                            <th style="padding-bottom: 10px;">Status : </th>
                            <td
                                <?php
                                if($row['status'] === 'confirmed') {
                                    echo "style='color: green; font-weight:600;padding-bottom:6px';";
                                } 
                                else if($row['status'] === 'cancelled') {
                                    echo "style='color: red; font-weight:600;padding-bottom:6px'";
                                }
                                ?>
                                >
                                <?php
                                    if($row['status'] === 'confirmed' || $row['status'] === 'cancelled')
                                        echo $row['status']; 
                                    else    
                                        echo "<p style='font-weight:600;color:#a67c07;padding-bottom:6px'>pending</p>";
                                ?>
                            </td>
                        </tr>
                    </table>
                <?php
                }
            } else {
                ?>
                <div class="no-order">
                    <p>You have no order's yet.</p>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
    <?php
    }
    if ($_SESSION['username'] !== 'admin') {
    ?>
        <footer> <small>&copy; Copyright 2022, Caterer Reservation and Ordering System. All Rights Reserved</small> </footer>
    <?php
    }
    ?>
</body>

</html>