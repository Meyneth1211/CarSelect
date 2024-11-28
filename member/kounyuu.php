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


$sql = 'SELECT car_id, image FROM image WHERE is_primary = 1 AND car_id IN(';
$placeholder = implode(',', $imageid);
$sql .= $placeholder;
$sql .= ');';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$images = $stmt->fetchall(PDO::FETCH_ASSOC);

echo '<div class="car-list">';
$c = 0;
foreach ($cars as $row) {
  echo '<a href="https://aso2301389.hippy.jp/carselect/member/car_detail?item=' . $row['car_id'] . '" class="car-item">'; // aタグを全体に適用
  echo '<div class="car-info">';
  echo '<div class="search-car-date"><h3>' . $row['car_name'] . '</h3>';
  echo '<div class="separator"></div>';
  echo '<p>' . $row['price'] . '円</p>';
  echo '</div></div>';
  echo '</a>'; // aタグを閉じる
  $c++;
}
echo '</div>';


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