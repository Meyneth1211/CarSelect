<?php require('../header/header.php'); ?>
    <div class="card">
        <div class="card-card">
    <form class="card-form" action="kounyuu.php" method="post">
    <h2>カード情報</h2>
    <div class="p-color">
    <p class="mclass">カード番号<input class="card-no" type="text" name="cardno" maxlength="16" required></p>
    <p class="mclass">セキュリティコード<input class="card-cord" type="password" name="cardpass" maxlength="3" size="5" required></p>
    <p class="mclass">カード名義<input class="card-name" type="text" name="cardname" maxlength="50" required></p>
    <p class="mclass">有効期限<input class="card-kigen" type="text" name="cardkigen1" maxlength="2" size="4" required>/<input class="card-kigen2" type="text" maxlength="2" size="4" required></p>
    </div>
    <div class="c-button">
    <p><input class="card-button" type="submit" value="送信"></p>
    </div>
    </form>
        </div>
    </div>
</body>
</html>