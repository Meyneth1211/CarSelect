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
    //var_dump($favlist);
    echo '<div class="car-list">';
    foreach ($favlist as $row) {
        echo '<a href="https://aso2301389.hippy.jp/carselect/member/car_detail?item=' . $row[0]['car_id'] . '" class="car-item">'; // aタグを全体に適用
        echo '<img src="' . $row[1]['image'] . '" alt="' . $row[0]['car_name'] . '">';
        echo '<div class="car-info">';
        echo '<div class="search-car-date"><h3>' . $row[0]['car_name'] . '</h3>';
        echo '<div class="separator"></div>';
        echo '<p>' . number_format($row[0]['price']) . '円</p>';
        echo '</div></div>';
        echo '</a>'; // aタグを閉じる
    }
    echo '</div>';
}



?>