<?php
session_start();
require('../header/header.php');
require_once '../DBconnect.php';
$pdo = getDb();

// セッションにユーザーIDがあるか確認
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォーム送信時の更新処理
        $user_mail = $_POST['user_mail'];
        $user_password = $_POST['user_password'];
        $user_address = $_POST['user_address'];

        // データベース更新
        $sql = $pdo->prepare('UPDATE user SET user_mail = ?, user_password = ?, user_address = ? WHERE user_id = ?');
        if ($sql->execute([$user_mail, $user_password, $user_address, $user_id])) {
            $message = 'アカウント情報を更新しました。';
        } else {
            $message = '更新に失敗しました。もう一度お試しください。';
        }
    } else {
        // 初期フォームのデータ取得
        $sql = $pdo->prepare('SELECT user_mail, user_password, user_address FROM user WHERE user_id = ?');
        $sql->execute([$user_id]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // データが取得できなかった場合
            echo '<p class="error">アカウント情報が見つかりませんでした。<a href="login.php">ログインし直してください。</a></p>';
            exit();
        }
    }
} else {
    // ユーザーIDがセッションに存在しない場合
    echo '<div class="account-error-back"><div class="account-error-card">';
    echo '<div class="account-message3">ログインしてください</div>';
    echo '<form class="login-form" action="login.php" method="post"><input class="button-1" type="submit" value="ログインする"></form></div></div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アカウント編集</title>
    <style>
        /* デザインは省略（前回と同じ） */
    </style>
</head>
<body>
    <div class="edit-back">
        <div class="edit-card">
            <h2>アカウント編集</h2>

            <?php if (isset($message)): ?>
                <p class="message"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <form action="account_update.php" method="post">
                <div class="form-group">
                    <label for="user_mail">メールアドレス</label>
                    <input type="email" id="user_mail" name="user_mail" 
                           value="<?= htmlspecialchars($user['user_mail'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="form-group">
                    <label for="user_password">パスワード</label>
                    <input type="password" id="user_password" name="user_password" 
                           value="<?= htmlspecialchars($user['user_password'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="form-group">
                    <label for="user_address">住所</label>
                    <input type="text" id="user_address" name="user_address" 
                           value="<?= htmlspecialchars($user['user_address'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="form-group">
                    <button type="submit">更新する</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
