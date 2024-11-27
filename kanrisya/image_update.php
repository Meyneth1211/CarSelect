<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';

$pdo = getDb();
// car_idの取得
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
} else {
    die('車両IDが指定されていません。');
}

// 画像データの取得
$sql = $pdo->prepare('SELECT * FROM image WHERE car_id = ?');
$sql->execute([$car_id]);
$images = $sql->fetchAll(); // 結果を配列として取得

// データがあるか確認
if (!empty($images)) {
    foreach ($images as $row) {
        // 画像データの処理
        echo htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
    }
} else {
    echo "画像データが見つかりません。";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品画像更新画面</title>
</head>
<body>
<form action="image_update_back.php" method="POST" enctype="multipart/form-data">
    <table class="image-table">
        <tr>
                <th>
                    <h3>メイン画像</h3>
                </th>
                <td>
                    <label for="main_image" class="file-upload">
                        <img src="../img/image.png" alt="アップローボタン" class="upload-button-image">
                    </label>
                    <input type="file" id="main_image" name="main_image" accept="image/*" style="display: none;" required><br>
                    <div id="main_image_preview" class="image-preview">
                        <p>ここに画像が表示されます</p>
                    </div>
                </td>
            </tr>

            <tr>
                <th>
                    <h3>その他の画像</h3>
                </th>
                <td>
                    <label for="other_images" class="file-upload">
                        <img src="../img/image.png" alt="複数アップローボタン" class="upload-button-image">
                    </label>
                    <input type="file" id="other_images" name="other_images[]" accept="image/*" multiple required style="display: none;"><br><br>
                    <div id="other_images_preview" class="image-preview">
                        <p>ここにその他の画像が表示されます</p>
                    </div>
                </td>
        </tr>
    </table>
    <div class="top-back-button">
        <button type="submit" class="updateButton">画像を更新する</button>
        <button type="button" class="back-button" onclick="location.href='car_list.php'">商品一覧へ戻る</button>
    </div>
</form>
<script src="../kanrisya_js/kanrisya_insert.js"></script>
</body>
</html>