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
$sql = "SELECT user_name, user_mail, user_password, user_address FROM user WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "ユーザー情報が見つかりません。";
    exit;
}
?>


    <div class="create">
        <div class="account-create-card">
            <h2>アカウント情報編集</h2>
            <form class="create-form" action="account_backend.php" method="POST">
                <label class="account_name" for="user_name">ユーザー名</label>
                <input class="name" type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                <label class="account_mail" for="user_mail">メールアドレス</label>
                <input class="mail" type="email" id="user_mail" name="user_mail" value="<?php echo htmlspecialchars($user['user_mail'], ENT_QUOTES, 'UTF-8'); ?>" required>
                <label class="account_password" for="user_password">パスワード</label>
                <input class="pass" type="password" id="user_password" name="user_password" value="<?php echo htmlspecialchars($user['user_password'], ENT_QUOTES, 'UTF-8'); ?>" required>
                <label class="account_address" for="user_address">住所</label>
                <input class="address" type="text" id="user_address" name="user_address" value="<?php echo htmlspecialchars($user['user_address'], ENT_QUOTES, 'UTF-8'); ?>" required>
                <span></span>
                <input class="button-1" type="submit" value="確定">
            </form>
            <form class="create-form" action="account.php" method="post">
                <input class="button-2" type="submit" value="戻る">
            </form>
        </div>
    </div>
</body>
</html>
