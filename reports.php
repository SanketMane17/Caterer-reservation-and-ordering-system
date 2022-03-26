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
    </section>
</body>

</html>