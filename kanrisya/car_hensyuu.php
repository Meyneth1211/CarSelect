<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';
$pdo = getDb();

// 編集対象のcar_idを受け取る
if (isset($_GET['edit_id'])) {
    $car_id = $_GET['edit_id'];

    // 車情報を取得
    $stmt = $pdo->prepare('SELECT * FROM car WHERE car_id = :car_id');
    $stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);
    $stmt->execute();
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        echo '<p>指定された車の情報が見つかりません。</p>';
        exit;
    }

    // 画像情報を取得
    $img_stmt = $pdo->prepare('SELECT * FROM image WHERE car_id = :car_id');
    $img_stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);
    $img_stmt->execute();
    $images = $img_stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    echo '<p>車IDが指定されていません。</p>';
    exit;
}

// 更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    // 車情報の更新
    $car_name = $_POST['car_name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $body_type = $_POST['body_type'];
    $car_detail = $_POST['car_detail'];
    $color = $_POST['color'];
    $stock = $_POST['stock'];
    $selected_image_id = $_POST['selected_image'] ?? null;

    $update_stmt = $pdo->prepare('
        UPDATE car 
        SET car_name = :car_name, brand = :brand, price = :price, 
            body_type = :body_type, car_detail = :car_detail, 
            color = :color, stock = :stock
        WHERE car_id = :car_id
    ');
    $update_stmt->bindValue(':car_name', $car_name, PDO::PARAM_STR);
    $update_stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
    $update_stmt->bindValue(':price', $price, PDO::PARAM_INT);
    $update_stmt->bindValue(':body_type', $body_type, PDO::PARAM_STR);
    $update_stmt->bindValue(':car_detail', $car_detail, PDO::PARAM_STR);
    $update_stmt->bindValue(':color', $color, PDO::PARAM_STR);
    $update_stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
    $update_stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        // 画像選択の更新
        if ($selected_image_id) {
            $reset_stmt = $pdo->prepare('UPDATE image SET is_primary = 0 WHERE car_id = :car_id');
            $reset_stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);
            $reset_stmt->execute();

            $update_img_stmt = $pdo->prepare('UPDATE image SET is_primary = 1 WHERE image_id = :image_id');
            $update_img_stmt->bindValue(':image_id', $selected_image_id, PDO::PARAM_INT);
            $update_img_stmt->execute();
        }

        // 削除する画像の処理
        if (isset($_POST['delete_images']) && is_array($_POST['delete_images'])) {
            foreach ($_POST['delete_images'] as $image_id) {
                $delete_stmt = $pdo->prepare('DELETE FROM image WHERE image_id = :image_id');
                $delete_stmt->bindValue(':image_id', $image_id, PDO::PARAM_INT);
                $delete_stmt->execute();
            }
        }

        // 新しい画像のアップロード処理
        if (!empty($_FILES['new_image']['name'])) {
            $image_path = '../img/uploads/' . basename($_FILES['new_image']['name']);
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $image_path)) {
                $add_img_stmt = $pdo->prepare('
                    INSERT INTO image (car_id, image, is_primary) VALUES (:car_id, :image, 0)
                ');
                $add_img_stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);
                $add_img_stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
                $add_img_stmt->execute();
            }
        }

        header("Location: {$_SERVER['PHP_SELF']}?edit_id=$car_id");
        exit;
    }
}
?>

<h1 class="page-title">車情報編集</h1>
<form class="hensyuu_form" method="post" enctype="multipart/form-data">
    <table class="edit-table">
        <tr>
            <th>車名</th>
            <td><input type="text" name="car_name" value="<?= htmlspecialchars($car['car_name'], ENT_QUOTES, 'UTF-8') ?>" required></td>
        </tr>
        <tr>
            <th>ブランド</th>
            <td><input type="text" name="brand" value="<?= htmlspecialchars($car['brand'], ENT_QUOTES, 'UTF-8') ?>" required></td>
        </tr>
        <tr>
            <th>価格</th>
            <td><input type="number" name="price" value="<?= htmlspecialchars($car['price'], ENT_QUOTES, 'UTF-8') ?>" required></td>
        </tr>
        <tr>
            <th>ボディタイプ</th>
            <td><input type="text" name="body_type" value="<?= htmlspecialchars($car['body_type'], ENT_QUOTES, 'UTF-8') ?>" required></td>
        </tr>
        <tr>
            <th>車の詳細</th>
            <td><textarea name="car_detail" cols="40" rows="8" required><?= htmlspecialchars($car['car_detail'], ENT_QUOTES, 'UTF-8') ?></textarea></td>
        </tr>
        <tr>
            <th>色</th>
            <td><input type="text" name="color" value="<?= htmlspecialchars($car['color'], ENT_QUOTES, 'UTF-8') ?>" required></td>
        </tr>
        <tr>
            <th>在庫数</th>
            <td><input type="number" name="stock" value="<?= htmlspecialchars($car['stock'], ENT_QUOTES, 'UTF-8') ?>" min="0" required></td>
        </tr>
        <tr>
            <th>画像削除</th>
            <td>
                <?php foreach ($images as $image): ?>
                    <label>
                        <input type="checkbox" name="delete_images[]" value="<?= $image['image_id'] ?>">
                        <img src="<?= htmlspecialchars($image['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Car Image" width="100">
                    </label>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>

    <h3>新しい画像を追加</h3>
    <input type="file" name="new_image" accept="image/*">

    <button class="save-button" type="submit" name="save_changes">更新確定</button>
    <button class="back-button" type="button" onclick="location.href='car_list.php'">キャンセル</button>
</form>
