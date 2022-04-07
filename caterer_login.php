<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login-register.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <title>Caterer Login</title>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="form-container" style="height: 95vh;">
        <div class="input-box">
            <h2>Caterer Login</h2>
            <input type="text" name="email" id="email-input" placeholder="Caterer Email" autocomplete="off"
            value="<?php
                if(isset($_POST['email']))
                    echo $_POST['email']; 
            ?>">
            <div id="email-error" style="margin-top: -10px;">Caterer Not Found.</div>
            
            <input type="password" name="c_pass" id="pwd-input" placeholder="Password">
            <div id="pwd-error" style="margin-top: -10px;">Incorrect Password.</div>

            <button type="submit" class="btn" name="login">Log In</button>
            <p>Don't yet registered? <a href="caterer_registration.php">Register</a>.</p>
        </div>
    </form>

    <?php

    if (isset($_POST['login'])) {
        include 'config.php';
        $email = $_POST['email'];
        $password = $_POST['c_pass'];

        $sql = $conn->query("SELECT email, password FROM caterer_registration WHERE email = '$email'");

        $row = $sql->fetch(PDO::FETCH_ASSOC);
        
        if($email === $row['email'] && !empty($username)){
            $_SESSION['c_email'] = $row['email'];
        }
        
        if ($email === $row['email'] && $password === $row['password']) {
            $_SESSION['c_password'] = $row['password'];
            header("Location:caterer_dashboard.php");
        }
        else if($emal !== $row['email']){
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
        else if(empty($email) || empty($password)) {
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