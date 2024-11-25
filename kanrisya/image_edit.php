<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';

$pdo = getDb();

// car_idの取得とバリデーション
if (isset($_GET['car_id']) && is_numeric($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
} else {
    die('車両IDが指定されていません。');
}

// 対象車両の画像データを取得
$sql = $pdo->prepare('SELECT image_id, image, is_primary FROM image WHERE car_id = ?');
$sql->execute([$car_id]);
$images = $sql->fetchAll();
?>

<h1 class="page-title">画像編集画面</h1>

<table class="image-table">
    <tr>
        <th>画像</th>
        <th>操作</th>
    </tr>
    <?php foreach ($images as $row): ?>
    <tr>
        <td>
            <form method="post" action="update_image.php">
                <button class="edit-button" type="submit" name="edit_image_id" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>">編集</button>
            </form>
        </td>
        <td>
            <form method="post" action="delete_image.php">
                <button class="delete-button" type="submit" name="delete_image_id" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>">削除</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="top-back-button">
    <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>
