<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';

$pdo = getDb();

// car_idとselected_imagesの受け取り
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
} else {
    die('車両IDが指定されていません。');
}

if (isset($_POST['selected_images']) && is_array($_POST['selected_images'])) {
    $selected_image_ids = $_POST['selected_images'];
} else {
    die('削除する画像が選択されていません。');
}

// 削除確認画面の表示
?>

<h1>画像削除確認</h1>
<p>選択された画像を削除しますか？</p>

<ul>
    <?php foreach ($selected_image_ids as $image_id): ?>
        <li>画像ID: <?= htmlspecialchars($image_id, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
</ul>

<!-- 削除確認ボタン -->
<form action="image_delete.php" method="POST">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="selected_images" value="<?= htmlspecialchars(implode(',', $selected_image_ids), ENT_QUOTES, 'UTF-8') ?>">

    <button type="submit" name="action" value="delete">削除する</button>
    <button type="button" onclick="history.back();">キャンセル</button>
</form>