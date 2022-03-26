<?php
    session_start();
    error_reporting(0);
    $_SESSION['reg-uname'] = $_POST['uname'];
    $_SESSION['reg-email'] = $_POST['email'];
    $_SESSION['reg-pwd'] = $_POST['pwd'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login-register.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <title>User Registration</title>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" class="form-container" style="height: 95vh;">
        <div class="input-box">
            <h2>Registration</h2>

            <div id="user">
                <input type="text" name="uname" id="user-input" placeholder="Username" 
                autocomplete="off"   value="<?php 
                if(isset($_SESSION['reg-uname'])){
                    echo $_POST['uname'];
                }?>">
                <div id="user-error">Username Aready Exists.</div>
                <div id="user-invalid">Please enter a valid username.</div>
             </div>

            <div id="email">
                <input type="text" name="email" id="email-input" placeholder="Email" autocomplete="off" 
                value="<?php 
                if(isset($_SESSION['reg-email'])){
                echo $_POST['email'];
                }?>">
                <div id="email-error">Email Aready Exists.</div>
                <div id="email-invalid">Invalid email address.</div>
            </div>

            <div id="password">
                <input type="password" id="pwd-input" name="pwd" placeholder="Password" 
                value="<?php 
                if(isset($_SESSION['reg-pwd'])){
                    echo $_POST['pwd'];
                }?>">
                <div id="pwd-error">Please Enter Password.</div>
                <div id="pwd-invalid">Password should be at least 6 characters in length and should include at least one  upper case letter, one number, and one special character.</div>
            </div>
            <div>
                <input type="password" id="pwd1-input" name="pwd1" placeholder="Re-enter Password" >
                <div id="pwd1-error">Password Cannot Matched.</div>
            </div>
            <button type="submit" class="btn" name="register">Register</button>
            <p>Already Registered? <a href="login.php">Log In</a>.</p>
        </div>
    </form>

    <?php
    include 'config.php';

    if (isset($_POST['register'])) {
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $password1 = $_POST['pwd'];
        $password2 = $_POST['pwd1'];

        $uppercase = preg_match('@[A-Z]@', $password1);
        $lowercase = preg_match('@[a-z]@', $password1);
        $number    = preg_match('@[0-9]@', $password1);
        $specialChars = preg_match('@[^\w]@', $password1);

        $userQuery = $conn->query("SELECT * FROM user_info WHERE uname = '$uname'");
        $emailQuery = $conn->query("SELECT * FROM user_info  WHERE email = '$email'");

        // Username validation
        if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $uname) && !empty($uname)) {
            ?>
             <script>
                document.getElementById("user-input").classList.add("error-border");
                document.getElementById("user-invalid").style.display = "inline";
            </script>
            <?php
        }

        else if($uname === $userQuery->fetch(PDO::FETCH_ASSOC)['uname'] && !empty($uname)) {
            ?>
            <script>
                document.getElementById("user-input").classList.add("error-border");
                document.getElementById("user-error").style.display = "inline";
            </script>
            <?php
        }

        // Email validation
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            ?>
            <script>
                document.getElementById("email-input").classList.add("error-border");
                document.getElementById("email-invalid").style.display = "inline";
            </script>
            <?php
        }
        
        else if($email === $emailQuery->fetch(PDO::FETCH_ASSOC)['email'] && !empty($email)){
            ?>
            <script>
                document.getElementById("email-input").classList.add("error-border");
                document.getElementById("email-error").style.display = "inline";
            </script>
           <?php
        }

        else if (empty($uname) || empty($email) || empty($password1)) {
            ?>
            <script>
                alert("Fields Cannot Be Empty!!")
            </script>
            <?php
        }

        // Password validation
        else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password1) < 6) {
            if(!empty($password1)) {
                ?>
                <script>
                    document.getElementById("pwd-input").classList.add("error-border");
                    document.getElementById("pwd-invalid").style.display = "inline";
                </script>
                <?php
            }
        }

        else if($password1 !== $password2 && !empty($password1)) {
            ?>
            <script>
                document.getElementById("pwd1-input").classList.add("error-border");
                document.getElementById("pwd1-error").style.display = "inline";
            </script>
            <?php
        }

        else if($password1 === $password2 && !empty($password1) && !empty($password2)) {
            $sql = "INSERT INTO user_info (uname, email, password) VALUES (?,?,?)";
            $conn->prepare($sql)->execute([$uname, $email, $password1]);
            ?>
            <script>
            alert("Registration successful, Please login");
            </script>
            <?php
            header("refresh: 1; url = http://localhost/college_php/Project/login.php");
        }
    }
    ?>
</body>

</html> 