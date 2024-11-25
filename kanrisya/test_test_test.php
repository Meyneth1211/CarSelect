<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';
$pdo = getDb();

// 編集対象のcar_idを受け取る
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

    // 該当車の画像情報を取得
    $stmt = $pdo->prepare('SELECT * FROM image WHERE car_id = :car_id');
    $stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$images) {
        echo '<p>画像が見つかりません。</p>';
        exit;
    }
} else {
    echo '<p>車IDが指定されていません。</p>';
    exit;
}

// 更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_image_id = $_POST['selected_image'];

    // すべての画像のis_primaryを0にリセット
    $reset_stmt = $pdo->prepare('UPDATE image SET is_primary = 0 WHERE car_id = :car_id');
    $reset_stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);
    $reset_stmt->execute();

    // 選択された画像のis_primaryを1に設定
    $update_stmt = $pdo->prepare('UPDATE image SET is_primary = 1 WHERE image_id = :image_id');
    $update_stmt->bindValue(':image_id', $selected_image_id, PDO::PARAM_INT);
    if ($update_stmt->execute()) {
        echo '<div class="message success">画像が正常に更新されました。</div>';
    } else {
        echo '<div class="message error">画像の更新に失敗しました。</div>';
    }
}
?>

<h1 class="page-title">画像選択編集</h1>
<form method="post" class="image-selection-form">
    <div class="image-list">
        <?php foreach ($images as $image): ?>
            <div class="image-item">
                <input type="radio" name="selected_image" value="<?= $image['image_id'] ?>" 
                    <?= $image['is_primary'] ? 'checked' : '' ?> required>
                <img src="<?= htmlspecialchars($image['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Car Image" width="150">
            </div>
        <?php endforeach; ?>
    </div>
    <button type="submit" class="save-button">保存</button>
    <button type="button" class="back-button" onclick="location.href='car_list.php'">キャンセル</button>
</form>

<style>
.page-title {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
}

.image-list {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
}

.image-item {
    text-align: center;
}

.image-item img {
    display: block;
    margin: 0 auto 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
}

.save-button, .back-button {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.save-button:hover {
    background-color: #2980b9;
}

.back-button {
    background-color: #e74c3c;
}

.back-button:hover {
    background-color: #c0392b;
}
</style>
