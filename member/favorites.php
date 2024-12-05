<?php
require('../header/header.php');
if (empty($_SESSION['id'])) {
    echo '<script>window.location.href = "login.php";</script>';
} else {
    require_once('./FavListHandler.php');
    echo <<<EOM
        <div class="favorite-title">
            <h1>お気に入り</h1>
        </div>
    EOM;
    $favlist=getFavList($_SESSION['id']);
    var_dump($favlist);
}



?>