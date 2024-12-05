<?php
if (empty($_SESSION['id'])) {
    header('Location: login.php');
} else {
    require('../header/header.php');
    echo <<<EOM
        <div class="favorite-title">
            '<h1>お気に入り</h1>'
        </div>
    EOM;
}



?>