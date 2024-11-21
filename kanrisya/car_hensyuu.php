<?php
require('kanrisya_header.php');
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
    $brand = $_POST['brand'];
    $car_name = $_POST['car_name'];
    $color = $_POST['color'];
    $stock = $_POST['stock'];

    $update_stmt = $pdo->prepare('
        UPDATE car 
        SET brand = :brand, car_name = :car_name, color = :color, stock = :stock 
        WHERE car_id = :car_id
    ');
    $update_stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
    $update_stmt->bindValue(':car_name', $car_name, PDO::PARAM_STR);
    $update_stmt->bindValue(':color', $color, PDO::PARAM_STR);
    $update_stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
    $update_stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        echo '<p>情報が正常に更新されました。</p>';
        echo '<button onclick="location.href=\'car_list.php\'">在庫管理画面に戻る</button>';
        exit;
    } else {
        echo '<p>更新に失敗しました。</p>';
    }
}
?>

<h1 class="page-title">車情報編集</h1>
<form method="post">
    <table class="edit-table">
        <tr>
            <th>ブランド</th>
            <td><input type="text" name="brand" value="<?= htmlspecialchars($car['brand'], ENT_QUOTES, 'UTF-8') ?>" required></td>
        </tr>
        <tr>
            <th>車名</th>
            <td><input type="text" name="car_name" value="<?= htmlspecialchars($car['car_name'], ENT_QUOTES, 'UTF-8') ?>" required></td>
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
