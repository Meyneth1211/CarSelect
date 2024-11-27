
メモリを更新しました
了解しました！画像の選択とアップロードを別々の画面に分ける方法で進めます。

1. 画像選択画面 (image_edit.php)
まず、画像を選択する画面を作成します。ここで画像のIDを選択し、それを次の画面に渡すためにフォームを送信します。

php
コードをコピーする
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

<form action="image_update.php" method="POST">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">

    <h1 class="page-title">画像一覧</h1>

    <table class="image-table">
        <tr>
            <td class="label-cell">メイン画像</td>
            <td class="image-cell">
                <?php foreach ($images as $row): ?>
                    <?php if ($row['is_primary'] == 1): ?>
                        <label class="edit_image-checkbox">
                            <input type="checkbox" name="selected_images[]" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>" hidden>
                            <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="メイン画像" class="editcar-image">
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
                        <label class="edit_image-checkbox">
                            <input type="checkbox" name="selected_images[]" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>" hidden>
                            <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="サブ画像" class="editcar-image">
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>

    <div class="top-back-button">
        <button type="submit" class="updateButton">画像を選択してアップロード</button>
        <button type="button" class="back-button" onclick="location.href='car_list.php'">商品一覧へ戻る</button>
    </div>
</form>
2. 画像アップロード画面 (image_update.php)
画像選択画面で選択された画像IDをimage_update.phpに送信し、そこで画像のアップロード処理を行います。

php
コードをコピーする
<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';

$pdo = getDb();

// car_idと選択された画像IDを受け取る
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
} else {
    die('車両IDが指定されていません。');
}

if (isset($_POST['selected_images']) && !empty($_POST['selected_images'])) {
    $selected_image_ids = $_POST['selected_images'];
} else {
    die('画像が選択されていません。');
}

?>

<form action="image_update_back.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">
    
    <h2>新しい画像をアップロード</h2>
    
    <table class="image-table">
        <tr>
            <td class="label-cell">メイン画像</td>
            <td>
                <label for="main_image" class="file-upload">
                    <img src="../img/image.png" alt="アップロード" class="upload-button-image">
                </label>
                <input type="file" id="main_image" name="main_image" accept="image/*" style="display: none;">
            </td>
        </tr>

        <tr>
            <td class="label-cell">サブ画像</td>
            <td>
                <label for="other_images" class="file-upload">
                    <img src="../img/image.png" alt="アップロード" class="upload-button-image">
                </label>
                <input type="file" id="other_images" name="other_images[]" accept="image/*" multiple style="display: none;">
            </td>
        </tr>
    </table>

    <div class="top-back-button">
        <button type="submit" class="updateButton">画像を更新する</button>
        <button type="button" class="back-button" onclick="location.href='car_list.php'">商品一覧へ戻る</button>
    </div>
</form>