<?php require('../header/header.php'); ?>
<?php
// DB接続
require_once '../DBconnect.php';
$pdo = getDB();

// POSTデータからcar_idを取得
$car_id = $_POST['car_id'] ?? null;

if ($car_id) {
    // データベースから条件に一致する画像を取得
    $sql = 'SELECT image FROM image WHERE car_id = ? AND is_primary = 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$car_id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

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
} else {
    echo '<p>car_idが送信されていません。</p>';
}




?>



            <form class="kounyuu1-form" action="car_detail.php" method="post">
                <input class="kounyuu-button1" type="submit" value="戻る">
            </form>
            <form class="kounyuu2-form" action="Purchase_confirmed.php" method="post">
                <input class="kounyuu-button2" type="submit" value="購入確定">
            </form>
        </div>
    </div>
</body>
</html>