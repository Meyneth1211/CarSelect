<?php require('../header/header.php'); ?>
 
    <div class="login">
        <div class="login-card">
            <h2>ログイン</h2>
            <form class="login-form" action="top.php" method="post">
                <input class="mail" name="mail" type="text" placeholder="Email">
                <input class="pass" name="pass" type="password" placeholder="Password">
                <div class="top"></div>
                <input class="button-1" type="submit" value="ログイン">
            </form>
            <form class="login-form" action="signup.php" method="post">
                    <input class="button-2" type="submit" value="アカウント新規作成">
            </form>
        </div>
    </div>
</body>
</html>