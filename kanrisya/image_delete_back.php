<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';

$pdo = getDb();

// car_idの取得とバリデーション
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
} else {
    die('車両IDが指定されていません。');
}

// 削除確認された画像IDを受け取る
if (isset($_POST['confirm_delete_images']) && !empty($_POST['confirm_delete_images'])) {
    $confirm_delete_image_ids = $_POST['confirm_delete_images'];
} else {
    die('削除する画像が選択されていません。');
}

// 削除された画像を1枚ずつ処理
foreach ($confirm_delete_image_ids as $image_id) {
    // 画像ファイルのパスを取得
    $sql = $pdo->prepare('SELECT image FROM image WHERE image_id = ?');
    $sql->execute([$image_id]);
    $image = $sql->fetchColumn();

    if ($image && file_exists($image)) {
        // ファイルシステムから画像を削除
        unlink($image);
    }

    // データベースから画像を削除
    $sql_delete = $pdo->prepare('DELETE FROM image WHERE image_id = ?');
    $sql_delete->execute([$image_id]);
}

echo "選択した画像の削除が完了しました。";
?>