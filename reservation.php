<?php
    session_start();
    error_reporting(0);

    if(isset($_SESSION['fname'])) {
        header("Location:reservation_details.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caterer Reservation</title>
    <link href="css/style.css?v=<?php echo time();?>" rel="stylesheet" type="text/css" />
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
        <div class="reservation">
            <h1>Create Reservation</h1>
            <div class="form">
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                    <table>
                        <tr>
                            <td><label for="fname">First Name</label>
                            </td>
                            <td>
                                <input type="text" name="fname" id="fname"
                                value="<?php
                                    if(isset($_POST['fname'])){
                                        echo $_POST['fname'];
                                    }
                                ?>" placeholder="Eg.John">
                                <div id="fname-invalid">Invalid first name.</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="lname">Last Name</label>
                            </td>
                            <td>
                                <input type="text" name="lname" id="lname"
                                value="<?php
                                    if(isset($_POST['lname'])){
                                        echo $_POST['lname'];
                                    }
                                ?>" placeholder="Eg.Cambly">
                                <div id="lname-invalid">Invalid last name.</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="address">Address</label>
                            </td>
                            <td><textarea name="address" id="address" cols="40" rows="5" placeholder="Eg.City, State, Postal Adderss."></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="contact">Contact</label>
                            </td>
                            <td>
                                <input type="text" name="contact" id="contact"
                                value="<?php
                                    if(isset($_POST['contact'])){
                                        echo $_POST['contact'];
                                    }
                                ?>" placeholder="Eg.9878782637">
                                <div id="contact-invalid">Invalid contact.</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email Address</label>
                            </td>
                            <td>
                                <input type="text" name="email" id="email"
                                value="<?php
                                    if(isset($_POST['email'])){
                                        echo $_POST['email'];
                                    }
                                ?>" placeholder="Eg.demo@gmail.com">
                                <div id="email-invalid">Invalid email address.</div>
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
                <img src="img/reserved.jpg" alt="Reservation Image">
            </div>
        </div>
    </section>

    <footer> <small>&copy; Copyright 2022, Caterer Reservation and Ordering System. All Rights Reserved</small> </footer>

    <?php
    if (isset($_POST['next'])) {

        if (!preg_match("/^[a-zA-z]+$/", $_POST['fname']) && !empty($_POST['fname'])) {
            ?>
            <script>
                document.getElementById("fname").classList.add("error-border");
                document.getElementById("fname-invalid").style.display = "block";
            </script>
            <?php
        } 
        
        else if (!preg_match("/^[a-zA-z]+$/", $_POST['lname']) && !empty($_POST['lname'])) {
            ?>
            <script>
                document.getElementById("lname").classList.add("error-border");
                document.getElementById("lname-invalid").style.display = "block";
            </script>
            <?php
        } 
        
        else if (!preg_match("/^[0-9]+$/", $_POST['contact']) && !empty($_POST['contact'])) {
            ?>
            <script>
                document.getElementById("contact").classList.add("error-border");
                document.getElementById("contact-invalid").style.display = "block";
            </script>
            <?php
        }
        
        else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['email'])) {
            ?>
            <script>
                document.getElementById("email").classList.add("error-border");
                document.getElementById("email-invalid").style.display = "block";
            </script>
            <?php
        }

        else if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['address']) ||
        empty($_POST['contact']) || empty($_POST['email'])) {
        ?>
        <script>
            alert("All Feilds are Compulsory.")
        </script>
        <?php
        }

        else {
            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['lname'] = $_POST['lname'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['contact'] = $_POST['contact'];
            $_SESSION['email'] = $_POST['email'];
            ?>
            <script>
            alert("Going to the Next Page.....");
            window.location.href = 'http://localhost/college_php/Project/reservation_details.php';
            </script>
            <?php
        }
    }
    ?>
</body>

</html>