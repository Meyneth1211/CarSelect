<?php require('../header/header.php'); ?>
<?php
// DB接続
require_once '../DBconnect.php';
$pdo = getDB();

// POSTデータからcar_idを取得
$car_id = $_POST['car_id'] ?? null;

if ($car_id) {
    // 在庫を1減らす処理
    $sql = 'UPDATE car SET stock = stock - 1 WHERE car_id = ? AND stock > 0';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$car_id]);

    // 更新された行数を確認
    if ($stmt->rowCount() > 0) {
        $message = '在庫が更新されました。';
    } else {
        $message = '在庫が不足しています。';
    }
} else {
    $message = 'car_idが送信されていません。';
}
?>

<div class="Purchase">
    <div class="Purchase_confirmed">
        <h1>ご注文が完了しました</h1>
        <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
        <form class="Purchase-form" action="top.php" method="post">
            <input class="topback-button" type="submit" value="トップページに戻る">
        </form>
    </div>
</div>
</body>
</html>
