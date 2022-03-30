<?php
    session_start();
    error_reporting(0);
    include 'config.php';

    if(!isset($_SESSION['fname'])) {
        header("Location:reservation.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <script src="js/script.js"></script>
    <script>
        function getCaterers(data) {
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("caterer").innerHTML = xhr.responseText;
                }
            }

            xhr.open("POST", "available_caterers.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send("option="+data);
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
                <li><a href="#" onclick="login_msg()" style="background-color: #e1f4ee;">Schedule a Reservation</a></li>
                <li><a href="#" onclick="login_msg()">My Orders</a></li>
                <?php
                } else {
                    ?>
                    <li><a href="#" style="background-color: #e1f4ee;">Schedule a Reservation</a></li>
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

    <section class="reservations">
        <div class="reservation" style="height: 100%;">
            <h1>Reservation Details</h1>
            <div class="form">
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                    <table>
                        <tr>
                            <td>
                                <label for="venue">Venue</label>
                            </td>
                            <td>
                                <input type="text" name="venue" id="venue" value="<?php
                                    if(isset($_POST['venue']))
                                        echo $_POST['venue'];
                                ?>" placeholder="Eg.Hall, Park, Garder">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="date">Date of Event</label>
                            </td>
                            <td><input type="date" name="date" id="date" value="<?php
                                if(isset($_POST['date'])) {
                                    echo $_POST['date'];
                                }
                            ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="time">Time of Event</label>
                            </td>
                            <td><input type="time" name="time" id="time" value="
                                <?php
                                    if(isset($_POST['time']))
                                        echo $_POST['time'];
                                ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="occasion">Occasion</label>
                            </td>
                            <td>
                            <select name="occasion" id="occasion" style="width:319px;" onchange="getCaterers(this.value)">
                                <option value="one">-Select One-</option>
                                <option <?php if($_POST['occasion'] === 'wedding') echo "selected='selected'"?> value="wedding">Wedding</option>
                                <option <?php if($_POST['occasion'] === 'corporate') echo "selected='selected'"?> value="corporate">Corporate</option>
                                <option <?php if($_POST['occasion'] === 'social') echo "selected='selected'"?> value="social">Social Event</option>
                                <option <?php if($_POST['occasion'] === 'celebration') echo "selected='selected'"?> value="celebration">Celebration Event</option>
                            </select>
                            <div id="occasion-invalid">Please Select at least one Occasion.</div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="caterer">Availabe Caterers</label>
                    </td>
                    <td>
                        <select name="caterer" id="caterer" style="width:319px;"> 
                            <option value="one">-Select One-</option>
                        </select>
                        <div id="caterer-invalid">Please Select at least one Caterer.</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="menu">Preferred Menu</label>
                            </td>
                            <td>
                            <select name="menu" id="menu" style="width:319px;">
                                <option value="one">-Select One-</option>
                                <option <?php if($_POST['menu'] === 'tea') echo "selected='selected'"?> value="tea">Morning and afternoon tea</option>
                                <option <?php if($_POST['menu'] === 'lunch') echo "selected='selected'"?> value="lunch">Lunch</option>
                                <option <?php if($_POST['menu'] === 'salads') echo "selected='selected'"?> value="salads">Salads</option>
                                <option <?php if($_POST['menu'] === 'drinks') echo "selected='selected'"?> value="drinks">Drinks</option>
                                <option <?php if($_POST['menu'] === 'desserts') echo "selected='selected'"?> value="desserts">Desserts</option>
                            </select>
                            <div id="menu-invalid">Please Select at least one Menu.</div>
                            </td>
                        <tr>
                            <td><label for="service">Service Type</label>
                            </td>
                            <td>
                            <select name="service" id="service" style="width:319px;">
                                <option value="one">-Select One-</option>
                                <option <?php if($_POST['service'] === 'onsite') echo "selected='selected'"?> value="onsite">On Site</option>
                                <option <?php if($_POST['service'] === 'pickup') echo "selected='selected'"?> value="pickup">Pick Up</option>
                                <option <?php if($_POST['service'] === 'staff') echo "selected='selected'"?> value="staff">Staff Required</option>
                            </select>
                            <div id="service-invalid">Please Select at least one Service.</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="peopleCount">Number of Peopels</label>
                            </td>
                            <td>
                                <input type="text" name="peopleCount" id="peopleCount"
                                value="<?php
                                    if(isset($_POST['peopleCount'])){
                                        echo $_POST['peopleCount'];
                                    }
                                ?>" placeholder="Eg.35">
                                <div id="peopleCount-invalid">Invalid people count.</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="budget">Your Budget</label>
                        </td>
                        <td>
                            <input type="text" name="budget" id="budget"
                            value="<?php
                                if(isset($_POST['budget'])){
                                    echo $_POST['budget'];
                                }
                            ?>" placeholder="Eg.45000.00(Rs)">
                            <div id="budget-invalid">Invalid budget.</div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="reset" class="button" value="Clear">
                                <input type="submit" class="button" name="next" value="Next" />
                            </td>
                        </tr>
                    </table>
                </form>
                <img style="top:79px;height:77vh;" src="img/reserved-1.jpg" alt="Reservation Image">
            </div>
        </div>
    </section>

    <footer> <small>&copy; Copyright 2022, Caterer Reservation and Ordering System. All Rights Reserved</small> </footer>

    <?php
    if (isset($_POST['next'])) {

        if($_POST['occasion'] === "one") {
            ?>
            <script>
                document.getElementById("occasion").classList.add("error-border");
                document.getElementById("occasion-invalid").style.display = "block";
            </script>
            <?php
        }

        else if($_POST['menu'] === "one") {
            ?>
            <script>
                document.getElementById("menu").classList.add("error-border");
                document.getElementById("menu-invalid").style.display = "block";
            </script>
            <?php
        }

        else if($_POST['service'] === "one") {
            ?>
            <script>
                document.getElementById("service").classList.add("error-border");
                document.getElementById("service-invalid").style.display = "block";
            </script>
            <?php
        }

        else if($_POST['caterer'] === "one") {
            ?>
            <script>
                document.getElementById("caterer").classList.add("error-border");
                document.getElementById("caterer-invalid").style.display = "block";
            </script>
            <?php
        }

        else if(!preg_match("/^[0-9]+$/", $_POST['peopleCount'])) {
            ?>
            <script>
                document.getElementById("peopleCount").classList.add("error-border");
                document.getElementById("peopleCount-invalid").style.display = "block";
            </script>
            <?php
        }

        else if(!preg_match("/^[0-9]+(?:\.[0-9]{0,2})?$/", $_POST['budget'])) {
            ?>
            <script>
                document.getElementById("budget").classList.add("error-border");
                document.getElementById("budget-invalid").style.display = "block";
            </script>
            <?php
        }

        else if(empty($_POST['venue']) || empty($_POST['date']) || empty($_POST['time']) || empty($_POST['peopleCount']) || empty($_POST['budget'])) {
            ?>
            <script>
                alert("All Feilds are Compulsory.")
            </script>
            <?php
        }        
                
        else {
            $_SESSION['venue'] = $_POST['venue'];
            $_SESSION['date'] = $_POST['date'];
            $_SESSION['time'] = $_POST['time'];
            $_SESSION['occasion'] = $_POST['occasion'];
            $_SESSION['service'] = $_POST['service'];
            $_SESSION['menu'] = $_POST['menu'];
            $_SESSION['peopleCount'] = $_POST['peopleCount'];
            $_SESSION['budget'] = $_POST['budget'];
            $_SESSION['caterer'] = $_POST['caterer'];
            $caterer = $_POST['caterer'];

            $selectCID = $conn->query("SELECT c_id FROM caterer_registration WHERE c_name = '$caterer'");

            $row = $selectCID->fetch(PDO::FETCH_ASSOC);

            $sql = "INSERT INTO reservation (fname, lname, address, contact, email, venue, date, time, occasion, menu, service, peoplecount, budget, caterer, uname, c_id) VALUES  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $conn->prepare($sql)->execute([$_SESSION['fname'], $_SESSION['lname'], $_SESSION['address'],$_SESSION['contact'], $_SESSION['email'], $_SESSION['venue'], $_SESSION['date'], $_SESSION['time'], $_SESSION['occasion'], $_SESSION['menu'], $_SESSION['service'], $_SESSION['peopleCount'], $_SESSION['budget'], $_SESSION['caterer'],  $_SESSION['username'], $row['c_id']]);

            $date = date("Y/M/D");
            $updateStatus = $conn->query("update caterer_registration, reservation set c_status = 'available' where caterer_registration.c_id = reservation.c_id AND reservation.date <> '$date'")

            ?>
            <script>
            alert("Reservation Successful...Please Confirm Your Order...");
            <?php
                unset($_SESSION["fname"]);
            ?>
            window.location.href = 'http://localhost/college_php/Project/orders.php';
            </script>
            <?php
        }
    }
    ?>
</body>

</html>