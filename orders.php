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
    <title>Reservation List</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <script src="js/script.js"></script>
    <script>
        function confirm_order(r_id) {
            var xhr;

            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else {
                xhr = ActiveXObject(Microsoft.XMLHTTP)
            }

            let text = "Are you sure want to Confirm this order?";
            if (confirm(text) == true) {
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.body.innerHTML = this.responseText;
                    }
                }
            }
            xhr.open('GET', "confirm_order.php?r_id="+r_id, true);
            xhr.send();
        }

        function cancel_order(r_id) {
            var xhr;

            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else {
                xhr = ActiveXObject(Microsoft.XMLHTTP)
            }

            let text = "Are you sure want to Remove this order?";
            if (confirm(text) == true) {
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.body.innerHTML = this.responseText;
                    }
                }
            }
            xhr.open('GET', "cancel_order.php?r_id="+r_id, true);
            xhr.send();
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
            if (!isset($_SESSION['username'])) {
            ?>
                <li><a href="#" onclick="login_msg()">Schedule a Reservation</a></li>
                <li><a href="#" onclick="login_msg()" style="background-color: #e1f4ee;">My Orders</a></li>
            <?php
            } else {
            ?>
                <li><a href="reservation.php">Schedule a Reservation</a></li>
                <li><a href="#" style="background-color: #e1f4ee;">My Orders</a></li>
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
                <button class="btn"><a href='registration.php'>Sign Up</a></button>
            <?php
            }
            ?>
        </div>
    </nav>

    <section class="admin">
        <div class="myorders">
        <?php
            $uname = $_SESSION['username'];
            $sql = $conn->query("SELECT * FROM reservation WHERE uname = '$uname'");
            $count = $sql->rowCount();
            if($count > 0) {

            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <table class="myorder">
                
                <tr>
                    <th id="order-id" colspan="2">Order Id #<?php echo $row['r_id']?></th>
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
                    <th>By Caterer : </th>
                    <td><?php echo $row['caterer']; ?></td>
                </tr>
                <tr class="table-btn"
                <?php
                    if($row['status'] === 'confirmed') {
                        echo "style='background-color: #367315bd;'";
                    }
                    else if($row['status'] === 'cancelled') {
                        echo "style='background-color: #f3105fd4;'";
                    }
                    else {
                        echo "style='background-color: aliceblue;'";
                    }
                ?>>
                    <th colspan="2">
                    <?php
                        if($row['status'] === 'confirmed') {
                            ?>
                            <p id="ordered" style="color: white">Order Successful</p>
                            <?php
                        }
                        else if($row['status'] == 'cancelled') {
                            ?>
                            <p id="cancelled" style="color: white">Order Cancelled</p>
                            <?php
                        }
                        else {
                            ?>
                            <button id="btn-1" onclick="confirm_order(<?php echo $row['r_id'];?>)">Confirm</button>
                            <button id="btn-2" onclick="cancel_order(<?php echo $row['r_id'];?>)">Cancel</button>
                            <?php
                        }
                    ?>
                </th>
                </tr>
                <?php
                }
            ?>
            </table>
            <?php
            }
            else {
                ?>
                <div class="no-order">
                    <p>You have nothing ordered yet.</p>
                </div>
                <?php
            }
            ?>
        </div>
    </section>

    <footer> <small>&copy; Copyright 2022, Caterer Reservation and Ordering System. All Rights Reserved</small> </footer>
</body>

</html>