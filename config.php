<?php
    try {
        $dbname = "mysql:host=localhost;dbname=tybcs_12269";
        $dbuser = 'root';
        $dbpass = '';
        $conn = new PDO($dbname, $dbuser, $dbpass);
    }
    catch(PDOException $e){
        echo "
            <script>
                alert('Connection unsuccessful')
            </script>
        ";
        echo $e->getMessage();
        die();
    }

?>