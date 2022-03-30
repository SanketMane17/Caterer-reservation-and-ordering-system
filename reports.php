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
    <title>Catering Services</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <script>
        function logout() {
            var xhr;

            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else {
                xhr = ActiveXObject(Microsoft.XMLHTTP)
            }

            let text = "Are you sure want to Logout?";
            if (confirm(text) == true) {
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.body.innerHTML = this.responseText;
                    }
                }
            }
            xhr.open('GET', "logout.php", true);
            xhr.send();
        }

        function login_msg() {
            let login = confirm("Please Login to Continue....");
            if(login === true) {
                window.location.href = "http://localhost/college_php/Project/login.php";
            }
        }
    </script>
</head>

<body>
    <nav id="navbar">
        <div id="logo">
            <a href="index.php"><img src="img/logo.jpg" alt="Company Logo"></a>
        </div>
        <ul>
            <li><a href="index.php" style="cursor: pointer;">Received Orders</a></li>
            <li style="background-color: #e1f4ee;"><a href="reports.php" style="cursor: pointer;">Reports</a></li>
        </ul>
        <div id="right-box">
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
        </div>
    </nav>
    <section class="reports">
        <p><?php echo date("d/m/Y");?></p>

        <table class="report">
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Event Date</th>
                <th>Order Status</th>
                <th>Catering Service</th>
                <th>Earning</th>
            </tr>
            <?php
                include "config.php";

                $sql = $conn->query("SELECT * FROM reservation, caterer_registration WHERE reservation.c_id = caterer_registration.c_id AND status = 'confirmed'");
                while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $row['r_id'];?></td>
                        <td><?php echo $row['fname']." ".$row['lname'];?></td>
                        <td><?php echo $row['contact'];?></td>
                        <td><?php echo $row['date'];?></td>
                        <td><?php echo $row['status'];?></td>
                        <td><?php echo $row['caterer'];?></td>
                        <td><?php echo $row['budget'];?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>

        <table class="report" style="width: 50%;">
            <?php
                $totalOrders = $conn->query("SELECT count(*) AS totalOrders FROM reservation WHERE status = 'confirmed'");
                $vegOrders = $conn->query("SELECT count(menu_type) AS vegOrders FROM caterer_registration, reservation WHERE caterer_registration.c_id = reservation.c_id AND menu_type = 'veg' AND reservation.status = 'confirmed'");
                $nonVegOrders = $conn->query("SELECT count(menu_type) AS nonVegOrders FROM caterer_registration, reservation WHERE caterer_registration.c_id = reservation.c_id AND menu_type = 'non-veg' AND reservation.status = 'confirmed'");
                $totalRevenue = $conn->query("SELECT SUM(budget) as totalRevenue FROM caterer_registration, reservation WHERE caterer_registration.c_id = reservation.c_id AND reservation.status = 'confirmed'");
                $td1 = $totalOrders->fetch(PDO::FETCH_ASSOC);
                $td2 = $vegOrders->fetch(PDO::FETCH_ASSOC);
                $td3 = $nonVegOrders->fetch(PDO::FETCH_ASSOC);
                $td4 = $totalRevenue->fetch(PDO::FETCH_ASSOC);

                ?>
                <tr>
                    <th>Total Orders</th>
                    <th>Veg Orders</th>
                    <th>Non-veg Orders</th>
                    <th>Total Revenue</th>
                </tr>
                <tr>
                    <td><?php echo $td1['totalOrders'];?></td>
                    <td><?php echo $td2['vegOrders'];?></tc>
                    <td><?php echo $td3['nonVegOrders'];?></td>
                    <td><?php echo $td4['totalRevenue'];?></td>
                </tr>
        </table>
    </section>
</body>

</html>