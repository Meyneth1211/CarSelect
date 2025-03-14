<?php
require('../header/header.php');
require_once '../DBconnect.php';
$pdo = getDb();

// セッションにユーザーIDがあるか確認
if (!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    // ユーザー情報を取得
    $sql = $pdo->prepare('SELECT user_name, user_mail, user_password, user_address FROM user WHERE user_id = ?');
    $sql->execute([$user_id]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo '<div class="account-back"><div class="account-card">';
        echo '<h2 class="account-message">アカウント情報</h2><br><br>';
        echo '<p class="account-message2">名前:' . $user['user_name'] . '</p><br>';
        echo '<p class="account-message2">メールアドレス: ' . $user['user_mail'] . '</p><br>';
        echo '<p class="account-message2">パスワード: ' . $user['user_password'] . '</p><br>';
        echo '<p class="account-message2">住所: ' . $user['user_address'] . '</p><br>';
        echo '<form class="login-form" action="account_update.php" method="get"><input class="button-1" type="submit" value="アカウント情報を編集する"></form>';
        echo '<form class="create-form" action="top.php" method="post"><input class="button-2" type="submit" value="トップページへ戻る"></form></div></div>';
    } else {
        echo 'アカウント情報が見つかりませんでした';
    }
} else {
    echo '<div class="account-error-back"><div class="account-error-card">';
    echo '<div class="account-message3">ログインしてください</div>';
    echo '<form class="login-form" action="login.php" method="get"><input class="button-2" type="submit" value="ログインする"></form></div></div>';
}
?>

