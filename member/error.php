<?php
session_start();
require('../header/header.php'); 

// エラーメッセージがない場合、リダイレクト
if (empty($_SESSION['error_message'])) {
    header("Location: login.php");
    exit;
}

$error_message = $_SESSION['error_message'];
unset($_SESSION['error_message']); // エラーメッセージを一度表示した後削除
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エラーメッセージ</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="error-container">
        <h2>エラーメッセージ</h2>
        <div class="error-message">
            <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <div>
            <a href="login.php" class="button">ログイン画面に戻る</a>
        </div>
    </div>
</body>
</html>
