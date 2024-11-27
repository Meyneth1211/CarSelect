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

<form action="../kanrisya/image_update.php" method="POST">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">
    
    <h1 class="page-title">画像一覧</h1>

    <table class="image-table">
        <?php foreach ($images as $row): ?>
            <tr>
                <td class="label-cell"><?= $row['is_primary'] == 1 ? 'メイン画像' : 'サブ画像' ?></td>
                <td class="image-cell">
                    <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= $row['is_primary'] == 1 ? 'メイン画像' : 'サブ画像' ?>" class="car-image">
                    <input type="checkbox" name="selected_images[]" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>">
                    <label>編集対象</label>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="top-back-button">
        <button type="submit" class="updateButton">選択した画像を編集する</button>
        <button type="button" class="back-button" onclick="location.href='car_list.php'">商品一覧へ戻る</button>
    </div>
</form>