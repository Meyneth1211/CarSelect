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
        $mainresult = $sql->execute([$main_image_path, $car_id]);
    }
}

// サブ画像のアップロード処理
if (isset($_FILES['other_images']) && count($_FILES['other_images']['tmp_name']) > 0) {
    $other_images = $_FILES['other_images']['tmp_name'];
    $other_images_names = $_FILES['other_images']['name'];

    // まず、古いサブ画像を削除
    $sql_delete_existing = $pdo->prepare('DELETE FROM image WHERE car_id = ? AND is_primary = 0');
    $sql_delete_existing->execute([$car_id]);

    // 新しいサブ画像を追加
    foreach ($other_images as $key => $tmp_name) {
        $image_path = '../img/detail/' . basename($other_images_names[$key]);

        if (move_uploaded_file($tmp_name, $image_path)) {
            // 新しいサブ画像を追加
            $sql_insert = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?, ?, 0)');
            $subresult = $sql_insert->execute([$car_id, $image_path]);
        }
    }

    if($mainresult & $subresult){
        echo '<div class="container">';
        echo '<div class="message success">選択された画像が更新されました</div>';
        echo '<button type="button" class="save-button" onclick="location.href=\'car_list.php\'">一覧画面へ戻る</button>';
        echo '<button class="back-button" onclick="location.href=\'kanrisya_top.php\'">トップページへ戻る</button>';
        echo '</div>';
    }
}
?>