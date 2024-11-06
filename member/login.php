<?php require('../header/header.php'); ?>
 
    <div class="login">
        <div class="login-card">
            <h2>ログイン</h2>
            <form class="login-form" action="">
                <input class="mail" type="text" placeholder="Email">
                <input class="pass" type="password" placeholder="Password">
                <div class="top"></div>
                <input class="button-1" type="submit" value="ログイン">
            </form>
            <form class="login-form" action="login-next.php" method="post">
                    <input class="button-2" type="submit" value="アカウント新規作成">
            </form>
        </div>
    </div>
</body>
</html>