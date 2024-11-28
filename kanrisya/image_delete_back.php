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

// 画像IDの取得とバリデーション
if (isset($_POST['selected_images']) && !empty($_POST['selected_images'])) {
    $selected_image_ids = explode(',', $_POST['selected_images']);
} else {
    die('削除する画像が選択されていません。');
}

// 画像削除処理
foreach ($selected_image_ids as $image_id) {
    // 画像情報を取得
    $sql = $pdo->prepare('SELECT image FROM image WHERE image_id = ?');
    $sql->execute([$image_id]);
    $image = $sql->fetchColumn();

    if ($image) {
        // 画像ファイルを削除
        if (file_exists($image)) {
            unlink($image); // ファイル削除
        }

        // DBから画像レコードを削除
        $delete_sql = $pdo->prepare('DELETE FROM image WHERE image_id = ?');
        $delete_sql->execute([$image_id]);
    }
}

echo "選択された画像が削除されました。";
?>