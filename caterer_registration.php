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
    <link href="css/login-register.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <title>Caterer Registration</title>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" class="form-container" enctype="multipart/form-data">
        <div class="input-box">
            <h2>Caterer Registration</h2>

            <div id="c-name">
                <input type="text" name="c_name" id="cname-input" placeholder="Caterer Name" value="<?php 
                if(isset($_POST['c_name'])){
                    echo $_POST['c_name'];
                }?>">
             </div>

            <div id="c-phone">
                <input type="text" name="c_phone" id="cphone-input" placeholder="Caterer Phone" value="<?php 
                if(isset($_POST['c_phone'])){
                echo $_POST['c_phone'];
                }?>">
                <div id="cphone-invalid">Invalid phone.</div>
            </div>

            <div id="location">
                <input type="text" id="location-input" name="location" placeholder="Catering Location" 
                value="<?php 
                if(isset($_POST['location'])){
                    echo $_POST['location'];
                }?>">
                <div id="location-invalid">Invalid location.</div>
            </div>
            <div id="menu-type">
                <select name="menu_type" id="menu_type">
                    <option value="one">-Select menu type-</option>
                    <option <?php if($_POST['menu_type'] === 'veg') echo "selected='selected'"?> value="veg">Veg</option>
                    <option <?php if($_POST['menu_type'] === 'non-veg') echo "selected='selected'"?> value="non-veg">Non-veg</option>
                </select>
                <div id="menu-invalid">Please Select at least one menu type.</div>
            </div>
            <div class="occasion-type">
                <select name="occasion_type" id="occasion_type">
                    <option value="one">-Select Occasion type-</option>
                    <option <?php if($_POST['occasion_type'] === 'wedding') echo "selected='selected'"?> value="wedding">Wedding</option>
                    <option <?php if($_POST['occasion_type'] === 'corporate') echo "selected='selected'"?> value="corporate">Corporate</option>
                    <option <?php if($_POST['occasion_type'] === 'social') echo "selected='selected'"?> value="social">Social Event</option>
                    <option <?php if($_POST['occasion_type'] === 'celebration') echo "selected='selected'"?> value="celebration">Celebration Event</option>
                </select>
                <div id="occasion-invalid">Please Select at least one occasion type.</div>
            </div>
            <div id="price">
                <input type="text" id="price-input" name="price" placeholder="Starting Price" value="<?php
                    if(isset($_POST['price']))
                        echo $_POST['price'];
                ?>">
                <div id="price-error">Invalid Price.</div>
            </div>
            <div id="about">
                <textarea name="about" cols="30" rows="5" placeholder="About your catering"></textarea>
            </div>
            <div id="image"> 
                <label for="image">Choose Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="status">
                <select name="status" id="status">
                    <option value="one">-Select status-</option>
                    <option <?php if($_POST['status'] === 'available') echo "selected='selected'"?> value="available">Availabe</option>
                    <option <?php if($_POST['status'] === 'not-available') echo "selected='selected'"?> value="not-available">Not-available</option>
                </select>
                <div id="status-invalid">Please select at least one status type.</div>
            </div>
            <button type="submit" class="btn" name="register">Register</button>
        </div>
    </form>

    <?php
    include 'config.php';

    if (isset($_POST['register'])) {
        $c_name = $_POST['c_name'];
        $c_phone = $_POST['c_phone'];
        $location = $_POST['location'];
        $menu_type = $_POST['menu_type'];
        $occasion_type = $_POST['occasion_type'];
        $about = $_POST['about'];
        $price = $_POST['price'];
        $c_status = $_POST['status'];

        // Image uploading
        $filename = $_FILES['image']['name'];
        $path = "upload/".$filename;
        

        if(!preg_match("/^[0-9]+$/", $c_phone) && !empty($c_phone)) {
            ?>
            <script>
                document.getElementById("cphone-input").classList.add("error-border");
                document.getElementById("cphone-invalid").style.display = "inline";
            </script>
            <?php
        }

        else if($menu_type === "one") {
            ?>
            <script>
                document.getElementById("menu_type").classList.add("error-border");
                document.getElementById("menu-invalid").style.display = "inline";
            </script>
            <?php
        }
        
        else if($occasion_type === "one") {
            ?>
            <script>
                document.getElementById("occasion_type").classList.add("error-border");
                document.getElementById("occasion-invalid").style.display = "inline";
            </script>
            <?php
        }
        
        else if(!preg_match("/^[0-9]+(?:\.[0-9]{0,2})?$/", $price) && !empty($price)) {
            ?>
            <script>
                document.getElementById("price-input").classList.add("error-border");
                document.getElementById("price-error").style.display = "inline";
            </script>
            <?php
        }
        
        else if($c_status === "one") {
            ?>
            <script>
                document.getElementById("status").classList.add("error-border");
                document.getElementById("status-invalid").style.display = "inline";
            </script>
            <?php
        }

        else if (empty($c_name) || empty($c_phone) || empty($location) || empty($price)) {
            ?>
            <script>
                alert("Fields Cannot Be Empty!!")
            </script>
            <?php
        }

        else {

            move_uploaded_file($filename, $path);

            $sql = "INSERT INTO caterer_registration (c_name, c_phone, location, menu_type, occasion_type, price, about, filename, c_status) VALUES (?,?,?,?,?,?,?,?,?)";
            $conn->prepare($sql)->execute([$c_name, $c_phone, $location, $menu_type, $occasion_type, $price, $about, $filename, $c_status]);
            ?>
            <script>
            alert("Caterer Registration successful");
            </script>
            <?php
            header("refresh: 1; url = http://localhost/college_php/Project/index.php");
        }
    }
    ?>
</body>

</html> 