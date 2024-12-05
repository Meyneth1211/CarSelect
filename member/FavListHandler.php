<?php
require_once '../DBconnect.php';

function getFavList($user){
    $pdo=getDB();
    $sql='SELECT * FROM favorite WHERE user_id = ?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$user]);
    $list=$stmt->fetchall(PDO::FETCH_ASSOC);
    if(!$list){
        $pdo=null;
        return false;
    }else{
        $image = [];
        foreach ($list as $row) {
            $image[]=$row['car_id'];
        }
        $sql = 'SELECT car_id, image FROM image WHERE is_primary = 1 AND car_id IN(';
        $placeholder = implode(',', $image);
        $sql .= $placeholder;
        $sql .= ');';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchall(PDO::FETCH_ASSOC);
        $pdo=null;
        return [$list,$images];
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

?>