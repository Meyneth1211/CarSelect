<?php
    $pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
    dbname=LAA1557132-carselect;charset=utf8',
    'LAA1557132',
    'asovehiclesd2b');
    foreach ($pdo->query('select * from user') as $row) {
        # code...
        echo '<p>';
        echo $row['user_id'],':';
        echo $row['user_name'],':';
        echo $row['user_mail'],':';
        echo $row['user_password'],':';
        echo $row['user_address'],':';
        echo '</p>';
    }
?>