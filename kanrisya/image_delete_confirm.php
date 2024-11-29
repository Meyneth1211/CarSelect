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

// 選択された画像データを取得
$placeholders = implode(',', array_fill(0, count($selected_image_ids), '?'));
$sql = $pdo->prepare("SELECT image_id, image FROM image WHERE image_id IN ($placeholders)");
$sql->execute($selected_image_ids);
$selected_images = $sql->fetchAll();

?>

<h1>画像削除確認</h1>
<p>選択された画像を削除しますか？</p>

<!-- 選択された画像を表形式で表示 -->
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>画像ID</th>
            <th>プレビュー</th>
            <th>画像パス</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($selected_images as $image): ?>
        <tr>
            <td><?= htmlspecialchars($image['image_id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>
                <img src="<?= htmlspecialchars($image['image'], ENT_QUOTES, 'UTF-8') ?>" alt="画像プレビュー" style="width: 400px; height: 150px; object-fit: cover;">
            </td>
            <td><?= htmlspecialchars($image['image'], ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- 削除確認ボタン -->
<form action="image_delete.php" method="POST">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="selected_images" value="<?= htmlspecialchars(implode(',', $selected_image_ids), ENT_QUOTES, 'UTF-8') ?>">

    <div style="margin-top: 20px;">
        <button type="submit" name="action" value="delete">削除する</button>
        <button type="button" onclick="history.back();">キャンセル</button>
    </div>
</form>