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

// 画像削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_images'])) {
    // チェックされた画像IDを取得
    $delete_ids = $_POST['delete_images'];
    foreach ($delete_ids as $image_id) {
        // 画像データの取得
        $sql = $pdo->prepare('SELECT image FROM image WHERE image_id = ?');
        $sql->execute([$image_id]);
        $image = $sql->fetchColumn();

        // 画像ファイルの削除
        if ($image && file_exists($image)) {
            unlink($image);  // 画像ファイル削除

            // データベースから削除
            $sql = $pdo->prepare('DELETE FROM image WHERE image_id = ?');
            $sql->execute([$image_id]);
        }
    }

    // 削除後にリダイレクト
    header("Location: image_edit.php?car_id=$car_id");
    exit(); // リダイレクト後にスクリプトの実行を終了
}
?>

<h1 class="page-title">画像一覧</h1>

<form method="POST">
    <table class="image-table">
        <tr>
            <!-- 項目名 -->
            <td class="label-cell">メイン画像</td>
            <td class="image-cell">
                <?php foreach ($images as $row): ?>
                    <?php if ($row['is_primary'] == 1): ?>
                        <!-- メイン画像もチェックボックスとして表示 -->
                        <label>
                            <input type="checkbox" name="delete_images[]" value="<?= $row['image_id'] ?>" />
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
                        <!-- サブ画像もチェックボックスとして表示 -->
                        <label>
                            <input type="checkbox" name="delete_images[]" value="<?= $row['image_id'] ?>" />
                            <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="サブ画像" class="car-image">
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>

    <!-- 画像削除ボタン -->
    <div>
        <button type="submit" class="delete-button">選択した画像を削除</button>
    </div>
</form>

<div class="top-back-button">
    <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>
