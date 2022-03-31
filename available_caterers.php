<?php
    include 'config.php';
    $occasion = $_POST['option1'];
    $menu_type = $_POST['option2'];
    $currentDate = date("Y/M/D");

    $sql = $conn->query("SELECT c_name FROM caterer_registration WHERE occasion_type = '$occasion'  AND menu_type = '$menu_type'");

    while($optionArray = $sql->fetch(PDO::FETCH_ASSOC)) {
        switch($occasion) {
            case 'wedding': 
                    foreach($optionArray as $opt) {
                        echo "<option value='$opt'>".ucwords($opt)."</option>";
                    }
                    break;
            case 'corporate': 
                    foreach($optionArray as $opt) {
                        echo "<option value='$opt'>".ucwords($opt)."</option>";
                    }
                    break;
            case 'social': 
                    foreach($optionArray as $opt) {
                        echo "<option value='$opt'>".ucwords($opt)."</option>";
                    }
                    break;
            case 'celebration': 
                    foreach($optionArray as $opt) {
                        echo "<option value='$opt'>".ucwords($opt)."</option>";
                    }
                    break;
        }
    }
?>