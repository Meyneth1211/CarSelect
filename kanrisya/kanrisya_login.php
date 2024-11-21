<?php require('kanrisya_header.php'); ?>

<div class="kanrisya_login">
        <div class="kanrisya_login_card">
            <h2>ログイン</h2>
            <form class="kanrisya_login_form" action="kanrisya_top.php" method="post">
                <input class="mail" name="mail" type="text" placeholder="Email"><br>
                <input class="pass" name="pass" type="password" placeholder="Password">
                <div class="top"></div>
                <input class="kanrisya_button_1" type="submit" value="ログイン">
            </form>
            <form class="kanrisya_login_form" action="kanrisya_signup.php" method="post">
                    <input class="kanrisya_button_2" type="submit" value="アカウント新規作成">
            </form>
        </div>
    </div>
</body>
</html>