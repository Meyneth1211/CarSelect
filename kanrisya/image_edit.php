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

<h1 class="page-title">画像編集</h1>

<!-- メイン画像とサブ画像 -->
<form method="post" action="update_images.php">
    <table class="image-table">
        <tr>
            <td class="label-cell">メイン画像</td>
            <td class="image-cell">
                <?php foreach ($images as $row): ?>
                    <?php if ($row['is_primary'] == 1): ?>
                        <label>
                            <input type="checkbox" name="delete_images[]" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>">
                            <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="メイン画像" class="car-image">
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <td class="label-cell">サブ画像</td>
            <td class="image-cell">
                <?php foreach ($images as $row): ?>
                    <?php if ($row['is_primary'] == 0): ?>
                        <label>
                            <input type="checkbox" name="delete_images[]" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>">
                            <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="サブ画像" class="car-image">
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>

    <div class="button-group">
        <button type="submit" class="delete-button">選択した画像を削除</button>
    </div>
</form>

<!-- 画像追加フォーム -->
<h2 class="subtitle">画像を追加する</h2>
<form method="post" action="add_image.php" enctype="multipart/form-data">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">
    <label>画像ファイルを選択: 
        <input type="file" name="image" accept="image/*" required>
    </label>
    <label>メイン画像として登録: 
        <input type="checkbox" name="is_primary" value="1">
    </label>
    <button type="submit" class="add-button">追加</button>
</form>

<div class="top-back-button">
    <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>
