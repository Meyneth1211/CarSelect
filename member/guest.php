<?php require('../header/header.php'); ?>
</body>
    <div class="guestcreate">
        <div class="guestcreate-card">
            <h2>ゲスト登録</h2>
            <form class="guestcreate-form" action="card.php" method="post" required>
                <input class="guestname" name="name" type="text" placeholder="name" required>
                <input class="guestmail" name="mail" type="email" placeholder="Email" required>
                <input class="guestaddress" name="address" type="text" placeholder="address" required>
                <div class="guesttop"></div>
                <input class="guestbutton" type="submit" value="登録">
            </form>
        </div>
    </div>
</html>