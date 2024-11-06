<?php
    function getDB(){
        $dsn='mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1557132-carselect;charset=utf8';
        $username='LAA1557132';
        $password='asovehiclesd2b';
        $pdo=new PDO($dsn,$username,$password);

        return $pdo;
    }
    

?>