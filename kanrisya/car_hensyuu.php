<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';
$pdo = getDb();
 
// 編集対象のcar_idを受け取る
if (isset($_GET['edit_id'])) {
    $car_id = $_GET['edit_id'];
 
    // データベースから該当車の情報を取得
    $stmt = $pdo->prepare('SELECT * FROM car WHERE car_id = :car_id');
    $stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);
    $stmt->execute();
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if (!$car) {
        echo '<p>指定された車の情報が見つかりません。</p>';
        exit;
    }
} else {
    echo '<p>車IDが指定されていません。</p>';
    exit;
}
 
// 更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_name = $_POST['car_name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $body_type = $_POST['body_type'];
    $car_detail = $_POST['car_detail'];
    $color = $_POST['color'];
    $stock = $_POST['stock'];
 
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
        echo '<div class="container">';
        echo '<div class="message success">情報が正常に編集されました。</div>';
        echo '<div class="button-group"><button class="nav-button" onclick="location.href=\'car_list.php\'">在庫管理画面に戻る</button></div>';
        exit;
    } else {
        echo '<div class="message error">更新が失敗しました。</div>';
    }
    echo '</div>';
}
?>
 
<h1 class="page-title">車情報編集</h1>
<form class="hensyuu_form" method="post">
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
    </table>
    <button class="save-button" type="submit">更新確定</button>
    <button class="back-button" type="button" onclick="location.href='car_list.php'">キャンセル</button>
</form>
 
<!-- ☟ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー -->