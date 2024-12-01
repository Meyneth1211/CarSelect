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
    echo '<div class="container">';
    echo '<div class="message error">更新する画像が選択されていません</div>';
    echo '<button type="button" class="save-button" onclick="history.back();">画像を選択する</button>';
    echo '<button class="back-button" onclick="location.href=\'kanrisya_top.php\'">トップページへ戻る</button>';
    echo '</div>';
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
                <div id="main_image_preview" class="image-preview">
                        <p>ここに画像が表示されます</p>
                </div>
            </td>
        </tr>

        <tr>
            <td class="label-cell">サブ画像</td>
            <td>
                <label for="other_images" class="file-upload">
                    <img src="../img/image.png" alt="アップロード" class="upload-button-image">
                </label>
                <input type="file" id="other_images" name="other_images[]" accept="image/*" multiple style="display: none;">
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
