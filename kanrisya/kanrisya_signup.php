<?php require('../kanrisya/kanrisya_header.php'); 
?>
</body>
    <div class="kanrisya_login">
        <div class="kanrisya_login_card">
            <h2>管理者登録</h2>
            <form class="kanrisya_login_form" action="kanrisya_signup_backend.php" method="post">
                <input class="mail" name="mail" type="email" placeholder="Email" required>
                <input class="pass" name="pass" type="password" placeholder="Password" required>
                <input class="kanrisya_button_1" type="submit" value="登録">
            </form>
            <form class="kanrisya_login_form" action="kanrisya_login.php" method="post">
                    <input class="kanrisya_button_2" type="submit" value="ログイン画面へ戻る">
            </form>
        </div>
    </div>
</html>