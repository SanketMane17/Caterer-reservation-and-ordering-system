<?php
    include "config.php";
    $r_id = $_GET['r_id'];
    $sql = $conn->query("UPDATE reservation SET status = 'confirmed' WHERE r_id  = '$r_id';");
    header("Location:orders.php");
?>