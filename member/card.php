<?php require('../header/header.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'] ?? null;
}
?>

<div class="card">
    <div class="card-card">
        <form class="card-form" action="kounyuu.php" method="post">
            <h2>カード情報</h2>
            <div class="p-color">
                <p class="mclass">カード番号<input class="card-no" type="text" name="cardno" maxlength="16" required></p>
                <p class="mclass">セキュリティコード<input class="card-cord" type="password" name="cardpass" maxlength="3" size="5" required></p>
                <p class="mclass">カード名義<input class="card-name" type="text" name="cardname" maxlength="50" required></p>
                <p class="mclass">有効期限<input class="card-kigen" type="text" name="cardkigen1" maxlength="2" size="4" required>/<input class="card-kigen2" type="text" maxlength="2" size="4" required></p>
            </div>
            <!-- car_id を 次のページに渡す -->
            <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?>">

            <div class="c-button">
                <p><input class="card-button1" type="submit" value="送信"></p>
            </div>
        </form>
        <form class="kounyuu1-form" action="car_detail.php" method="get">
            <input type="button" class="kounyuu-button1" value="戻る" onclick="location.href='car_detail.php?item=<?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?>'">
        </form>

    </div>
</div>
</body>
</html>
