<?php 
session_start(); // セッション開始を最初に記述
require('../header/header.php'); 
?>
 
<div class="login"> 
    <div class="login-card">
        <h2>ログイン</h2>
        <form class="login-form" action="" method="post">
            <?php
            require_once '../DBconnect.php';
            $pdo = getDb();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST['mail']) && empty($_POST['pass'])) {
                    echo '<div class="error-message">EmailとPasswordを入力してください</div><br>';
                } else {
                    $sql = $pdo->prepare('SELECT * FROM user WHERE user_mail = ? AND user_password = ?');
                    $sql->execute([$_POST['mail'], $_POST['pass']]);
                    $row = $sql->fetch();

                    if ($row) {
                        $_SESSION['mail'] = $row['user_mail'];
                        $_SESSION['name'] = $row['user_name'];
                        header("Location: top.php"); // ログイン成功時にトップページへリダイレクト
                        exit;
                    } else {
                        echo '<div class="error-message">EmailかPasswordが違います</div><br>';
                        echo '<div class="error-message"><a href="login.php">戻る</a></div>';
                    }
                }
            }
            ?>
            <input class="mail" name="mail" type="text" placeholder="Email">
            <input class="pass" name="pass" type="password" placeholder="Password">
            <input class="button-1" type="submit" value="ログイン">
        </form>
        <form class="login-form" action="signup.php" method="post">
            <input class="button-2" type="submit" value="アカウント新規作成">
        </form>
    </div>
</div>
</body>
</html>
