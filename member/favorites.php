<?php
require('../header/header.php');
if (empty($_SESSION['id'])) {
    echo '<script>window.location.href = "login.php";</script>';
} else {
    require_once('./FavListHandler.php');
    $favlist=getFavList($_SESSION['id']);
    if (empty($favlist)) {
        //echo 'お気に入りリストに車が登録されていません。';
        echo '<div class="account-error-back"><div class="account-error-card">';
        echo '<div class="account-message3">お気に入りリストに車が登録されていません。</div>';
        echo '<form class="login-form" action="top.php" method="get"><input class="button-2" type="submit" value="トップページへ戻る"></form></div></div>';
    } else {
        echo <<<EOM
        <div class="favorite-back-card">
        <div class="favorite-title">
            <h1>お気に入り</h1>
        </div>
        EOM;
        echo '<div class="car-list">';
        foreach ($favlist as $row) {
            echo '<a href="https://aso2301389.hippy.jp/carselect/member/car_detail?item=' . $row['car_id'] . '" class="car-item2">'; // aタグを全体に適用
            echo '<img src="' . $row['image'] . '" alt="' . $row['car_name'] . '">';
            echo '<div class="car-info">';
            echo '<div class="search-car-date"><h3>' . $row['car_name'] . '</h3>';
            echo '<div class="separator"></div>';
            echo '<p>' . number_format($row['price']) . '円</p>';
            if (chkFavItem($_SESSION['id'],$row['car_id'])) {
                echo '<form action="FavListEditer.php" method="post">';
                  echo '<input type="hidden" name="car_id" value="'.$row['car_id'].'">';
                  echo '<input type="hidden" name="action" value="del">';
                  echo '<input type="hidden" name="url" value="'. $_SERVER['REQUEST_URI'].'">';
                  echo '<button type="submit" class="iine">';
                    echo '<i class="fas fa-heart" style="color:#FF0000;"></i><!-- <img src="icon.png" alt="Submit" style="width: 24px; height: 24px;"> -->';
                  echo '</button>';
                echo '</form>';
            } else {
                echo '<form action="FavListEditer.php" method="post">';
                echo '<input type="hidden" name="car_id" value="'.$row['car_id'].'">';
                echo '<input type="hidden" name="action" value="add">';
                echo '<input type="hidden" name="url" value="'. $_SERVER['REQUEST_URI'].'">';
                  echo '<button type="submit" class="iine">';
                    echo '<i class="far fa-heart" style="color:#FF0000;"></i><!--<img src="icon.png" alt="Submit" style="width: 24px; height: 24px;"> -->';
                  echo '</button>';
                echo '</form>';
            }
            echo '</div></div>';
            echo '</a>'; // aタグを閉じる
        }
        echo '</div>';
        echo '</div>';
    }
    
}


?>