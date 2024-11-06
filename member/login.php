<?php
session_start(); // セッション開始は最初に記述
require('../header/header.php'); // 必ずこの行も最初に記述

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../DBconnect.php';
    $pdo = getDb(); // DB接続

    // 入力値の検証
    if (empty($_POST['mail']) || empty($_POST['pass'])) {
        $_SESSION['error_message'] = "EmailとPasswordを入力してください";
        header("Location: error.php"); // エラー画面にリダイレクト
        exit;
    }

    try {
        $sql = $pdo->prepare('SELECT * FROM user WHERE user_mail = ? AND user_password = ?');
        $sql->execute([$_POST['mail'], $_POST['pass']]);
        $row = $sql->fetch();

        if ($row) {
            $_SESSION['mail'] = $row['user_mail'];
            $_SESSION['name'] = $row['user_name'];
            header("Location: top.php"); // トップページへリダイレクト
            exit;
        } else {
            $_SESSION['error_message'] = "EmailかPasswordが違います";
            header("Location: error.php"); // エラー画面にリダイレクト
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "データベースエラー: " . $e->getMessage();
        header("Location: error.php"); // エラー画面にリダイレクト
        exit;
    }
}
?>

<!-- HTMLコンテンツ -->
<div class="login">
    <div class="login-card">
        <h2>ログイン</h2>
        <form class="login-form" action="" method="post">
            <input class="mail" name="mail" type="text" placeholder="Email" required>
            <input class="pass" name="pass" type="password" placeholder="Password" required>
            <input class="button-1" type="submit" value="ログイン">
        </form>
        <form class="login-form" action="signup.php" method="post">
            <input class="button-2" type="submit" value="アカウント新規作成">
        </form>
    </div>
</div>
</body>
</html>
