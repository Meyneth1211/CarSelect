<?php require('../header/header.php'); ?>
<?php
// DB接続
require_once '../DBconnect.php';
$pdo = getDB();

// POSTデータからcar_idを取得
$car_id = $_POST['car_id'] ?? null;

if ($car_id) {
    // データベースから画像を取得
    $sql = 'SELECT image FROM image WHERE car_id = ? AND is_primary = 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$car_id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    // carテーブルからcar_nameとpriceを取得
    $car_sql = 'SELECT car_name, price FROM car WHERE car_id = ?';
    $car_stmt = $pdo->prepare($car_sql);
    $car_stmt->execute([$car_id]);
    $car_info = $car_stmt->fetch(PDO::FETCH_ASSOC);

    echo '<div class="kounyuu">';
    echo '<div class="kounyuu-card">';

    if ($image) {
        // 画像を表示
        echo '<div class="primary-image">';
        echo '<img src="' . htmlspecialchars($image['image'], ENT_QUOTES, 'UTF-8') . '" alt="Primary Car Image" />';
        echo '</div>';
    } else {
        echo '<p>該当する画像が見つかりませんでした。</p>';
    }

    if ($car_info) {
        // car_nameとpriceを表示
        echo '<div class="car-info">';
        echo '<h3>' . htmlspecialchars($car_info['car_name'], ENT_QUOTES, 'UTF-8') . '</h3>';
        echo '<div class="separator"></div>';
        echo '<p>価格: ¥' . number_format($car_info['price']) . '</p>';
        echo '</div>';
    } else {
        echo '<p>該当する車情報が見つかりませんでした。</p>';
    }
} else {
    echo '<p>car_idが送信されていません。</p>';
}
?>


<form class="kounyuu2-form" action="Purchase_confirmed.php" method="post">
    <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?>">
    <input class="kounyuu-button2" type="submit" value="購入確定">
</form>
<form class="kounyuu1-form" action="car_detail.php" method="post">
    <input type="button" class="kounyuu-button1" value="戻る" onclick="location.href='car_detail.php?item=<?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?>'">
</form>
</div>
</div>
</body>
</html>