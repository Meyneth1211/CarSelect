<?php require('../header/header.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'] ?? null;
    if ($car_id) {
        echo '受け取った car_id: ' . htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8');
        // car_id を利用した処理を記述
    } else {
        echo 'car_id が送信されていません。';
    }
}
?>

    <div class="kounyuu">
        <div class="kounyuu-card">
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