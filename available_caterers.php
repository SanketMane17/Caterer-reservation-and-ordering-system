<?php
    $option = $_POST['option'];
    include 'config.php';

    $sql = $conn->query("SELECT c_name FROM caterer_registration WHERE occasion_type = '$option'");
    $optionArray = $sql->fetch(PDO::FETCH_ASSOC);

    switch($option) {
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
?>