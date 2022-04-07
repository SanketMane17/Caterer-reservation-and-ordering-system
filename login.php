<?php
    session_start();
    error_reporting(0);
    if (isset($_SESSION['username']) && isset($_SESSION['password']) || $_SESSION['username'] === "admin") {
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login-register.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <title>User Login</title>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="form-container" style="height: 95vh;">
        <div class="input-box">
            <h2>Login</h2>
            <input type="text" name="u_name" id="user-input" placeholder="Username" autocomplete="off"
            value="<?php
                if(isset($_POST['u_name']))
                    echo $_POST['u_name']; 
            ?>">
            <div id="user-error" style="margin-top: -10px;">Username Not Found.</div>
            
            <input type="password" name="u_pass" id="pwd-input" placeholder="Password">
            <div id="pwd-error" style="margin-top: -10px;">Incorrect Password.</div>

            <button type="submit" class="btn" name="login">Log In</button>
            <p>Don't have an account? <a href="user_registration.php">Register</a>.</p>
        </div>
    </form>

    <?php

    if (isset($_POST['login'])) {
        include 'config.php';
        $username = $_POST['u_name'];
        $password = $_POST['u_pass'];

        $sql = $conn->query("SELECT uname, password FROM user_info WHERE uname = '$username'");

        $row = $sql->fetch(PDO::FETCH_ASSOC);
        
        if($username === $row['uname'] && !empty($username)){
            $_SESSION['username'] = $row['uname'];
        }
        
        if ($username === $row['uname'] && $password === $row['password']) {
            $_SESSION['password'] = $row['password'];

            $currentDate = date("Y/M/D");;
            // Update status of caterer

            $selectCID = $conn->query("SELECT distinct(caterer_registration.c_id), c_status FROM caterer_registration, reservation WHERE caterer_registration.c_id = reservation.c_id;");

            while($row = $selectCID->fetch(PDO::FETCH_ASSOC)) {
                $cid = $row['c_id'];
                $sql = "UPDATE caterer_registration, reservation SET c_status = 'not-available' WHERE caterer_registration.c_id = reservation.c_id and caterer_registration.c_id = '$cid'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            }

            header("Location:index.php");
        }
        else if($username !== $row['uname']){
            ?>
            <script>
                document.getElementById("user-input").classList.add("error-border");
                document.getElementById("user-error").style.display = "inline";
            </script>
            <?php
        }
        else if($password !== $row['password'] && !empty($password)){
            ?>
            <script>
                document.getElementById("pwd-input").classList.add("error-border");
                document.getElementById("pwd-error").style.display = "inline";
            </script>
            <?php
        }
        else if(empty($username) || empty($password)) {
            ?>
            <script>
                alert("Fields Cannot Be Empty!!");
            </script>
            <?php
        }
    }
    ?>
</body>

</html>