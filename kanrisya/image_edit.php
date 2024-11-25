<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';
$pdo = getDb();

// 編集対象の車IDを取得
if (isset($_GET['edit_image_id'])) {
    $car_id = $_GET['edit_image_id'];
} else {
    echo '車両IDが指定されていません。';
    exit;
}

// 該当する車両の画像データを取得
$sql = $pdo->prepare('SELECT * FROM image WHERE car_id = :car_id');
$sql->execute([':car_id' => $car_id]);
$images = $sql->fetchAll();
?>

<h1 class="page-title">画像管理画面</h1>

<!-- 車両IDの表示 -->
<p><strong>対象車両ID:</strong> <?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?></p>

<!-- 画像一覧の表示 -->
<table class="image-table">
    <tr>
        <th>image_id</th>
        <th>car_id</th>
        <th>画像パス</th>
        <th>メイン画像</th>
        <th>操作</th>
    </tr>
    <?php foreach ($images as $image): ?>
    <tr>
        <td><?php echo htmlspecialchars($image['image_id'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($image['car_id'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($image['image'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo $image['is_primary'] == 1 ? 'はい' : 'いいえ'; ?></td>
        <td>
            <!-- 編集ボタン -->
            <form method="get" action="image_single_edit.php" style="display:inline;">
                <button type="submit" name="image_id" value="<?php echo htmlspecialchars($image['image_id'], ENT_QUOTES, 'UTF-8'); ?>">編集</button>
            </form>

            <!-- コピーボタン -->
            <form method="post" action="image_copy.php" style="display:inline;">
                <button type="submit" name="image_id" value="<?php echo htmlspecialchars($image['image_id'], ENT_QUOTES, 'UTF-8'); ?>">コピー</button>
            </form>

            <!-- 削除ボタン -->
            <form method="post" action="image_delete.php" style="display:inline;">
                <button type="submit" name="image_id" value="<?php echo htmlspecialchars($image['image_id'], ENT_QUOTES, 'UTF-8'); ?>">削除</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- 新しい画像を追加するフォーム -->
<h2>新しい画像を追加</h2>
<form method="post" action="image_add.php" enctype="multipart/form-data">
    <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?>">
    <label for="new-image">画像を選択:</label>
    <input type="file" id="new-image" name="new_image" accept="image/*" required>
    <label for="is-primary">メイン画像にする:</label>
    <input type="checkbox" id="is-primary" name="is_primary" value="1">
    <button type="submit">画像を追加</button>
</form>

<div class="top-back-button">
    <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>
