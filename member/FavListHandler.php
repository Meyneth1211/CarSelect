<?php
require_once '../DBconnect.php';

function getFavList($user){
    $pdo=getDB();
    $sql='SELECT car_id FROM favorite WHERE user_id = ?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$user]);
    $list=$stmt->fetchall(PDO::FETCH_COLUMN);
    //var_dump($list);
    if(!$list){
        $pdo=null;
        return false;
    }else{
        $placeholder = implode(',', $list);
        $sql = 'SELECT car.car_id, car.car_name, car.price, image.image FROM car INNER JOIN image ON car.car_id = image.car_id WHERE car.car_id IN(';
        $sql .= $placeholder;
        $sql .= ') AND image.is_primary = 1;';
        //echo $sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
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

function chkFavItem($user, $car){
    $pdo=getDB();
    $sql='SELECT * FROM favorite WHERE user_id = ? AND car_id = ?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$user,$car]);
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    $pdo=null;
    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

$v1=chkFavItem(26,90);
$v2=chkFavItem(26,105);
echo $v1;
echo $v2;

?>