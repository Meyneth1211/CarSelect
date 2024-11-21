<?php
require_once '../DBconnect.php';
$pdo = getDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $stock = $_POST['stock'];

    // 在庫数を更新するSQL
    $sql = 'UPDATE car SET stock = :stock WHERE car_id = :car_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);

    // 実行
    if ($stmt->execute()) {
        // 更新が成功した場合
        header('Location: car_list.php');  // 在庫管理画面にリダイレクト
        exit;
    } else {
        // 更新が失敗した場合
        echo '在庫の更新に失敗しました。';
    }
}
?>
