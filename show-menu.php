<?php
    include "config.php";
    error_reporting(0);
    $caterer = $_POST['caterer'];
    $sql = $conn->query("SELECT menu_item FROM caterer_registration WHERE c_name = '$caterer'");

    $row = $sql->fetch(PDO::FETCH_ASSOC);

    echo $row['menu_item'];
?>