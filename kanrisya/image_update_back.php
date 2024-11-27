<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';

$pdo = getDb();

// car_idと画像IDを受け取る
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
} else {
    die('車両IDが指定されていません。');
}

if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] == 0) {
    // メイン画像のアップロード処理
    $main_image = $_FILES['main_image']['tmp_name'];
    $main_image_name = basename($_FILES['main_image']['name']);
    $main_image_path = '../img/detail/' . $main_image_name;

    if (move_uploaded_file($main_image, $main_image_path)) {
        // メイン画像の更新
        $sql = $pdo->prepare('UPDATE image SET image = ? WHERE car_id = ? AND is_primary = 1');
        $sql->execute([$main_image_path, $car_id]);
    }
}

// サブ画像のアップロード処理
if (isset($_FILES['other_images']) && count($_FILES['other_images']['tmp_name']) > 0) {
    $other_images = $_FILES['other_images']['tmp_name'];
    $other_images_names = $_FILES['other_images']['name'];

    foreach ($other_images as $key => $tmp_name) {
        $image_path = '../img/detail/' . basename($other_images_names[$key]);

        if (move_uploaded_file($tmp_name, $image_path)) {
            // サブ画像の更新・追加処理
            // 既存のサブ画像を削除して新しい画像に更新
            $sql = $pdo->prepare('UPDATE image SET image = ? WHERE car_id = ? AND is_primary = 0 AND image = ?');
            $sql->execute([$image_path, $car_id, $image_path]);

            // もしサブ画像がまだ登録されていない場合は新しく追加する
            $sql_check = $pdo->prepare('SELECT COUNT(*) FROM image WHERE car_id = ? AND is_primary = 0 AND image = ?');
            $sql_check->execute([$car_id, $image_path]);
            $count = $sql_check->fetchColumn();

            if ($count == 0) {
                $sql_insert = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?, ?, 0)');
                $sql_insert->execute([$car_id, $image_path]);
            }
        }
    }
}

echo "画像の更新が完了しました。";
?>