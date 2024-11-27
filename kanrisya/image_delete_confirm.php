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

// 削除する画像IDの取得
if (isset($_POST['delete_images']) && !empty($_POST['delete_images'])) {
    $delete_image_ids = $_POST['delete_images'];
} else {
    die('削除する画像が選択されていません。');
}

// 対象画像情報を取得
$sql = $pdo->prepare('SELECT image_id, image FROM image WHERE image_id IN (' . implode(',', array_fill(0, count($delete_image_ids), '?')) . ')');
$sql->execute($delete_image_ids);
$images_to_delete = $sql->fetchAll();

?>

<h1 class="page-title">削除確認</h1>

<p>以下の画像を削除します。よろしいですか？</p>

<table class="image-table">
    <tr>
        <th>画像</th>
        <th>削除確認</th>
    </tr>
    <?php foreach ($images_to_delete as $image): ?>
        <tr>
            <td><img src="<?= htmlspecialchars($image['image'], ENT_QUOTES, 'UTF-8') ?>" alt="画像" class="editcar-image"></td>
            <td><input type="checkbox" name="confirm_delete_images[]" value="<?= htmlspecialchars($image['image_id'], ENT_QUOTES, 'UTF-8') ?>" checked> 削除</td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="image_update_back.php" method="POST">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="delete_images" value="<?= htmlspecialchars(implode(',', $delete_image_ids), ENT_QUOTES, 'UTF-8') ?>">

    <div class="top-back-button">
        <button type="submit" class="updateButton">削除実行</button>
        <button type="button" class="back-button" onclick="history.back()">戻る</button>
    </div>
</form>