<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー削除確認</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_mail'])) {
    $userMail = $_POST['delete_user_mail'];
} else {
    die('<p style="color: red;">不正なアクセスです。</p>');
}
?>

<h1>ユーザー削除確認</h1>
<p>以下のユーザーを削除しますか？</p>
<p>メールアドレス: <?= htmlspecialchars($userMail, ENT_QUOTES, 'UTF-8') ?></p>

<form action="user_delete.php" method="post">
    <input type="hidden" name="delete_user_mail" value="<?= htmlspecialchars($userMail, ENT_QUOTES, 'UTF-8') ?>">
    <input type="submit" name="user-delete" value="削除する">
    <button type="button" onclick="history.back();">戻る</button>
</form>
</body>
</html>