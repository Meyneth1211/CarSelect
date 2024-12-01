<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';

$pdo = getDb();

// car_idを取得
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
} else {
    die('車両IDが指定されていません。');
}

// 選択されたサブ画像IDを取得
$selected_sub_image_ids = isset($_POST['selected_sub_image_ids']) ? $_POST['selected_sub_image_ids'] : [];

// メイン画像のアップロード処理
if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
    $main_image_tmp = $_FILES['main_image']['tmp_name'];
    $main_image_name = basename($_FILES['main_image']['name']);
    $main_image_path = '../img/detail/' . $main_image_name;

    if (move_uploaded_file($main_image_tmp, $main_image_path)) {
        // メイン画像のデータベース更新
        $sql = $pdo->prepare('UPDATE image SET image = ? WHERE car_id = ? AND is_primary = 1');
        $main_update_result = $sql->execute([$main_image_path, $car_id]);
    } else {
        echo 'メイン画像のアップロードに失敗しました。';
        exit;
    }
} else {
    // メイン画像がアップロードされなかった場合、データベースを更新しない
    $main_update_result = true; // 他の処理に影響を与えないためにtrueをセット
}

// サブ画像のアップロード処理
$sub_update_result = true;
if (isset($_FILES['other_images']) && count($_FILES['other_images']['tmp_name']) > 0) {
    $other_images = $_FILES['other_images']['tmp_name'];
    $other_images_names = $_FILES['other_images']['name'];

    foreach ($other_images as $key => $tmp_name) {
        if (!empty($tmp_name)) {
            $image_path = '../img/detail/' . basename($other_images_names[$key]);

            if (move_uploaded_file($tmp_name, $image_path)) {
                // 新しいサブ画像をデータベースに挿入
                $sql_insert = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?, ?, 0)');
                $sub_update_result &= $sql_insert->execute([$car_id, $image_path]);
            } else {
                echo 'サブ画像のアップロードに失敗しました。';
                $sub_update_result = false;
            }
        }
    }
}

// 古いサブ画像の削除
if (!empty($selected_sub_image_ids)) {
    $placeholders = implode(',', array_fill(0, count($selected_sub_image_ids), '?'));
    $sql_delete_existing = $pdo->prepare("DELETE FROM image WHERE car_id = ? AND is_primary = 0 AND image_id IN ($placeholders)");
    $sub_update_result &= $sql_delete_existing->execute(array_merge([$car_id], $selected_sub_image_ids));
}

// 処理結果を表示
if ($main_update_result && $sub_update_result) {
    echo '<div class="container">';
    echo '<div class="message success">画像が正常に更新されました。</div>';
    echo '<button type="button" class="save-button" onclick="location.href=\'car_list.php\'">一覧画面へ戻る</button>';
    echo '<button class="back-button" onclick="location.href=\'kanrisya_top.php\'">トップページへ戻る</button>';
    echo '</div>';
} else {
    echo '<div class="container">';
    echo '<div class="message error">画像の更新に失敗しました。</div>';
    echo '<button type="button" class="save-button" onclick="history.back();">戻る</button>';
    echo '</div>';
}
?>