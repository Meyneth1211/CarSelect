<?php
require_once '../DBConnect.php';

function getFavList($user){
    $pdo=getDB();
    $sql='SELECT * FROM favorite WHERE user_id = ?';
    $stmt=$pdo->prepare($sql);
    $list=$pdo->execute([$user]);
    $pdo=null;
    return $list;
}

function addFavItem($user, $car){
    $pdo=getDB();
    $sql='INSERT INTO favorite (user_id, car_id) VALUES (?,?)';
    $stmt=$pdo->prepare($sql);
    $result=$stmt->execute([$user,$car]);
    $pdo=null;
    return $result;
}

function delFavItem($user, $car){
    $pdo=getDB();
    $sql='DELETE FROM favorite WHERE user_id = ? AND car_id = ? LIMIT 1';
    $stmt=$pdo->prepare($sql);
    $result=$stmt->execute([$user,$car]);
    $pdo=null;
    return $result;
}


?>