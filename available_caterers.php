<?php
    $option = $_POST['option'];
    include 'config.php';
    $currentDate = date("Y/M/D");

    $sql = $conn->query("SELECT c_name FROM caterer_registration, reservation WHERE caterer_registration.c_id = reservation.c_id AND occasion_type = '$option' AND reservation.date <> '$currentDate'");
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