<?php require('../header/header.php'); ?>
    <div class="card">
        <div class="card-card">
    <form class="login-form" action="">
    <h2>カード情報</h2>
    <p>カード番号<input class="card-no"type="text" name="cardno" maxlength="16"></p>
    <p>セキュリティコード<input class="card-cord"type="text" name="cardpass" maxlength="3" size="5"></p>
    <p>カード名義<input class="card-name" type="text" name="cardname" maxlength="50"></p>
    <p>有効期限<input class="card-kigen" type="text" name="cardkigen" maxlength="2" size="4">/<input type="text" maxlength="2" size="4"></p>
    <p><input class="card-button" type="submit" onclick="location.href='./kounyuu.html'" value="送信"></p>
        </div>
    </div>
</body>
</html>