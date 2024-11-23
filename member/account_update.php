<?php
session_start();
require('../header/header.php');
require_once '../DBconnect.php';
$pdo = getDb();

// セッションから user_id を取得
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo "ログインしてください。";
    exit;
}

// ログイン中のユーザー情報を取得
$sql = "SELECT user_name, user_mail, user_address FROM user WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "ユーザー情報が見つかりません。";
    exit;
}
?>


    <div class="account-back">
        <div class="account-card">
            <h1>アカウント情報編集</h1>
            <form class="create-form" action="account_backend.php" method="POST">
                <label for="user_name">ユーザー名:</label>
                <input type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                <label for="user_mail">メールアドレス:</label>
                <input type="email" id="user_mail" name="user_mail" value="<?php echo htmlspecialchars($user['user_mail'], ENT_QUOTES, 'UTF-8'); ?>" required>
                <label for="user_address">住所:</label>
                <input type="text" id="user_address" name="user_address" value="<?php echo htmlspecialchars($user['user_address'], ENT_QUOTES, 'UTF-8'); ?>" required>
                <input class="button-2" type="submit" value="確定">
            </form>
            <form class="create-form" action="account.php" method="post">
                <input class="button-2" type="submit" value="戻る">
            </form>
        </div>
    </div>
</body>
</html>
