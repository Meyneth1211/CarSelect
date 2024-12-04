<?php
require_once '../DBConnect.php';

function getFavList($user){
    $pdo=getDB();
    $pdo=null;
}

function addFavItem($user, $car){
    $pdo=getDB();
    $sql='INSERT INTO favorite (user_id, car_id) VALUES (?,?)';
    $stmt=$pdo->prepare($sql);
    $result=$stmt->execute([$user,$car]);
    return $result;
    $pdo=null;
}

function delFavItem($user, $car){
    $pdo=getDB();
    $pdo=null;
}


?>