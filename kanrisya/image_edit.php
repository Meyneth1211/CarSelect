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

<h1 class="page-title">画像一覧</h1>

<table class="image-table">
    <tr>
        <th>メイン画像</th>
        <th>サブ画像</th>
    </tr>
    <tr>
        <!-- メイン画像 -->
        <td>
            <?php foreach ($images as $row): ?>
                <?php if ($row['is_primary'] == 1): ?>
                    <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="メイン画像" class="car-image">
                <?php endif; ?>
            <?php endforeach; ?>
        </td>
        <!-- サブ画像 -->
        <td>
            <?php foreach ($images as $row): ?>
                <?php if ($row['is_primary'] == 0): ?>
                    <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="サブ画像" class="car-image">
                <?php endif; ?>
            <?php endforeach; ?>
        </td>
    </tr>
</table>

<div class="top-back-button">
    <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>
