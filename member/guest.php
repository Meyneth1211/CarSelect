<?php require('../header/header.php'); ?>
</body>
    <div class="guestcreate">
        <div class="guestcreate-card">
            <h2>新規会員登録</h2>
            <form class="guestcreate-form" action="" method="post">
                <input class="guestname" name="name" type="text" placeholder="name">
                <input class="guestmail" name="mail" type="email" placeholder="Email">
                <input class="guestaddress" name="address" type="text" placeholder="address">
                <div class="guesttop"></div>
                <input class="guestbutton-1" type="submit" value="登録">
            </form>
            <form class="guestcreate-form" action="guest.php" method="post">
                    <input class="guestbutton-2" type="submit" value="ログイン画面へ戻る">
            </form>
        </div>
    </div>
</html>