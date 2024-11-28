<?php require('../header/header.php'); ?>
<?php
// DB接続
require_once '../DBconnect.php';
$pdo = getDB();

// POSTデータからcar_idを取得
$car_id = $_POST['car_id'] ?? null;

if ($car_id) {
    // データベースから条件に一致するcar_name, price, 画像を取得
    $sql = 'SELECT car_name, price, image FROM cars 
            LEFT JOIN image ON cars.car_id = image.car_id 
            WHERE cars.car_id = ? AND image.is_primary = 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$car_id]);
    $car_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($car_data) {
        echo '<div class="kounyuu">';
        echo '<div class="kounyuu-card">';
        // 車名と価格を表示
        echo '<h2>' . htmlspecialchars($car_data['car_name'], ENT_QUOTES, 'UTF-8') . '</h2>';
        echo '<p>価格: ¥' . number_format($car_data['price']) . '</p>';
        
        // 画像を表示
        if (!empty($car_data['image'])) {
            echo '<div class="primary-image">';
            echo '<img src="' . htmlspecialchars($car_data['image'], ENT_QUOTES, 'UTF-8') . '" alt="Primary Car Image" />';
            echo '</div>';
        } else {
            echo '<p>画像が見つかりません。</p>';
        }
        echo '</div>';
    } else {
        echo '<p>該当する車が見つかりませんでした。</p>';
    }
} else {
    echo '<p>car_idが送信されていません。</p>';
}
?>

<div class="kounyuu">
    <form class="kounyuu1-form" action="car_detail.php" method="post">
        <input class="kounyuu-button1" type="submit" value="戻る">
    </form>
    <form class="kounyuu2-form" action="Purchase_confirmed.php" method="post">
        <!-- car_id を次のページに送信 -->
        <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?>">
        <input class="kounyuu-button2" type="submit" value="購入確定">
    </form>
</div>
</body>
</html>
