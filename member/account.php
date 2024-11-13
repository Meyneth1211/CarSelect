<?php
session_start();
require('../header/header.php');
require_once '../DBconnect.php';
$pdo = getDb();

// セッションにユーザーIDがあるか確認
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // ユーザー情報を取得
    $sql = $pdo->prepare('SELECT user_mail, user_password, user_address FROM user WHERE user_id = ?');
    $sql->execute([$user_id]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo '<h2>アカウント情報</h2>';
        echo '<p>メールアドレス: ' . $user['user_mail'] . '</p>';
        echo '<p>パスワード: ' . $user['user_password'] . '</p>';
        echo '<p>住所: ' . $user['user_address'] . '</p>';
    } else {
        echo 'アカウント情報が見つかりませんでした。';
    }
} else {
    echo 'ログインしてください。';
}
?>
