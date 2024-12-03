<?php require('../header/header.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'] ?? null;
}
?>

<body>
    <div class="guestcreate">
        <div class="guestcreate-card">
            <h2>ゲストで購入</h2>
            <form class="guestcreate-form" action="card.php" method="post" required>
                <input class="guestname" name="name" type="text" placeholder="name" required>
                <input class="guestmail" name="mail" type="email" placeholder="Email" required>
                <input class="guestaddress" name="address" type="text" placeholder="address" required>
                <div class="guesttop"></div>
                <!-- car_id渡す -->
                <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?>">
                <input class="guestbutton" type="submit" value="登録">
            </form>
            <form class="login-form" action="signup.php" method="post">
                <input class="button-2" type="submit" value="アカウント新規作成">
            </form>
        </div>
    </div>
</body>
</html>