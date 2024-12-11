<?php
    header('Location: https://aso2301389.hippy.jp/carselect/member/top.php');//他の画面に遷移したいとき。先頭に書く。
    session_start();

    $_SESSION = array();//空の配列を渡すセッション中身消す

    if(isset($_COOKIE['PHPSESSID'])){
        setcookie('PHPSESSID','', time() - 1800, '/');
    }

    session_destroy();

?>