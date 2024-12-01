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
    echo '<div class="container">';
    echo '<div class="message error">削除する画像が選択されていません</div>';
    echo '<button type="button" class="save-button" onclick="history.back();">画像を選択する</button>';
    echo '<button class="back-button" onclick="location.href=\'kanrisya_top.php\'">トップページへ戻る</button>';
    echo '</div>';
    exit;
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
        $delete_imageresult = $delete_sql->execute([$image_id]);
    }
}
    if($delete_imageresult){
        echo '<div class="container">';
        echo '<div class="message success">選択された画像が削除されました</div>';
        echo '<button type="button" class="save-button" onclick="history.back();">一覧画面へ戻る</button>';
        echo '<button class="back-button" onclick="location.href=\'kanrisya_top.php\'">トップページへ戻る</button>';
        echo '</div>';
    }
?>