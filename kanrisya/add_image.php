<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';

$pdo = getDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $is_primary = isset($_POST['is_primary']) ? 1 : 0;

    // メイン画像は1枚制限
    if ($is_primary == 1) {
        $pdo->prepare('UPDATE image SET is_primary = 0 WHERE car_id = ?')->execute([$car_id]);
    }

    // ファイルアップロード処理
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $uploadDir = '../uploads/';
        $uploadPath = $uploadDir . basename($fileName);

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $sql = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?, ?, ?)');
            $sql->execute([$car_id, $uploadPath, $is_primary]);
        }
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
