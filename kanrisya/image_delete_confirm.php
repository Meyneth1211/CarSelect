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


// actionの取得
$action = $_POST['action'] ?? '';

// 画像の更新処理（actionがdeleteの場合）
if ($action == 'delete') {
// 画像IDの取得とバリデーション
if (isset($_POST['selected_images']) && is_array($_POST['selected_images'])) {
    $selected_image_ids = $_POST['selected_images'];
} else {
    die('削除する画像が選択されていません。');
}

// 削除する画像IDを表示（確認用）
echo "<h2>削除確認</h2>";
echo "<p>選択された画像を削除しますか？</p>";

foreach ($selected_image_ids as $image_id) {
    // 画像IDを確認表示
    echo "<p>画像ID: " . htmlspecialchars($image_id, ENT_QUOTES, 'UTF-8') . "</p>";
}
}
?>

<form action="image_delete_back.php" method="POST">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="selected_images[]" value="<?= implode(',', $selected_image_ids) ?>"> <!-- 画像IDの配列を送信 -->
    
    <button type="submit" class="deleteButton">削除する</button>
    <button type="button" class="back-button" onclick="history.back()">戻る</button>
</form>