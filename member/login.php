<?php require('../header/header.php'); ?>
 
<div class="login">
    <div class="login-card">
        <h2>ログイン</h2>
        <form class="login-form" action="top.php" method="post">
            <?php
            session_start();
            require_once '../DBconnect.php';
            $pdo = getDb();

            if (!empty($_POST['mail']) && !empty($_POST['pass'])) {
                $sql = $pdo->prepare('SELECT * from user where user_mail=? and user_password=?');
                $sql->execute([$_POST['mail'], $_POST['pass']]);
                $row = $sql->fetch();

                if ($row) {
                    $_SESSION['mail'] = $row['user_mail'];
                    $_SESSION['name'] = $row['user_name'];
                } else {
                    echo '<div class="Error-Message">EmailかPasswordが違います</div><br>';
                    echo '<div class="Error-Message"><a href="login.php">戻る</a></div>';
                    exit;
                }
            }
            ?>
            <input class="mail" type="text" name="mail" placeholder="Email"> 
            <input class="pass" type="password" name="pass" placeholder="Password">
            <input class="button-1" type="submit" value="ログイン">
        </form>
        <form class="login-form" action="signup.php" method="post">
            <input class="button-2" type="submit" value="アカウント新規作成">
        </form>
    </div>
</div>
