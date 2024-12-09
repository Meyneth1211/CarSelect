<?php
require_once '../DBconnect.php';

function getFavList($user){
    $pdo=getDB();
    $sql='SELECT car_id FROM favorite WHERE user_id = ?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$user]);
    $list=$stmt->fetchall(PDO::FETCH_COLUMN);
    var_dump($list);
    if(!$list){
        $pdo=null;
        return false;
    }else{
        /*
        $sql = 'SELECT car_id, car_name, price, (SELECT image FROM image WHERE image.is_primary = 1 AND image.car_id IN(';
        //$sql = 'SELECT car_id, image FROM image WHERE is_primary = 1 AND car_id IN(';
        $placeholder = implode(',', $list);
        $sql .= $placeholder;
        $sql .= ')) AS image FROM car WHERE car_id IN(';
        $sql .= $placeholder;
        $sql .= ');';
        */
        $sql = 'SELECT car.car_id, car.car_name, car.price, image.image FROM car INNER JOIN image ON car.car_id = image.car_id WHERE car.car_id IN(?) AND image.is_primary = 1;';
        echo $sql;
        $placeholder = implode(',', $list);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$placeholder]);
        $fav = $stmt->fetchall(PDO::FETCH_ASSOC);
        $pdo=null;
        return $fav;
    }
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

$fav=getFavList(26);

?>