<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';

$pdo = getDb();

// car_id の取得
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
} else {
    die('車両IDが指定されていません。');
}

// 選択された画像IDを取得
if (isset($_POST['selected_images']) && is_array($_POST['selected_images'])) {
    $selected_images = $_POST['selected_images'];
} else {
    die('編集する画像が選択されていません。');
}

// 選択された画像を削除
foreach ($selected_images as $image_id) {
    $sql = $pdo->prepare('DELETE FROM image WHERE image_id = ?');
    $sql->execute([$image_id]);
}

// 新しい画像のアップロード
if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
    // メイン画像のアップロード処理
    $main_image_path = uploadImage($_FILES['main_image'], '../uploads/');
    $sql = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?, ?, 1)');
    $sql->execute([$car_id, $main_image_path]);
}

if (isset($_FILES['other_images']) && count($_FILES['other_images']['name']) > 0) {
    foreach ($_FILES['other_images']['name'] as $key => $name) {
        if ($_FILES['other_images']['error'][$key] === UPLOAD_ERR_OK) {
            // その他の画像のアップロード処理
            $sub_image_path = uploadImage([
                'name' => $_FILES['other_images']['name'][$key],
                'tmp_name' => $_FILES['other_images']['tmp_name'][$key],
                'error' => $_FILES['other_images']['error'][$key],
            ], '../uploads/');
            $sql = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?, ?, 0)');
            $sql->execute([$car_id, $sub_image_path]);
        }
    }
}

// 画像アップロード処理の関数
function uploadImage($file, $upload_dir)
{
    $file_name = uniqid() . '_' . basename($file['name']);
    $target_path = $upload_dir . $file_name;
    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        return $target_path; // 成功時にパスを返す
    } else {
        die('画像のアップロードに失敗しました。');
    }
}

echo "画像を更新しました。";
?>
