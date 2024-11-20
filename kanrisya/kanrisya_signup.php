<?php require('../kanrisya/kanrisya_header.php'); 
?>
</body>
    <div class="create">
        <div class="create-card">
            <h2>管理者登録</h2>
            <form class="create-form" action="signup_backend.php" method="post">
                <input class="mail" name="mail" type="email" placeholder="Email" required>
                <input class="pass" name="pass" type="password" placeholder="Password" required>
                <div class="top"></div>
                <input class="button-1" type="submit" value="登録">
            </form>
            <form class="create-form" action="login.php" method="post">
                    <input class="button-2" type="submit" value="ログイン画面へ戻る">
            </form>
        </div>
    </div>
</html>