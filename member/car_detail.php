<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>車の詳細 - Car Select</title>
    <?php
        $car=$_GET['item'];
        echo '<link rel="stylesheet" href="../css/style_for_car_detail.php?item=' . $car .'" type="text/css">';
    ?>
</head>

<body>
    <!-- ヘッダ呼び出し -->
    <?php require('../header/header.php'); ?>

    <div class="car_detail_tail">
        <div class="car_detail_card">
            <div class="car-image">
                <?php
                //GETメソッドによる値受け渡し
                //URLのクエリパラメータからitemという変数名で車IDを取得
                $item = $_GET['item'];
                require_once '../DBconnect.php';
                $pdo = getDB();
                $sql = "SELECT COUNT(*) FROM image WHERE car_id = ?";
                //$sql="SELECT image FROM image WHERE car_id = ? ORDER BY is_primary DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$item]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $result['COUNT(*)'];
                //echo '<h2>行数：'. $count .'</h2>';
                echo '<ul class="slider">';
                for ($i = 0; $i < $count; $i++) {
                    echo '<li class="slider-item slider-item' . $i . '"></li>';
                }
                echo '</ul>';
                ?>
            </div>
            <form action="card.php" method="post">
                <div class="car-info">
                    <?php
                    $sql = 'SELECT * FROM car WHERE car_id = ?';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$item]);
                    $info = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo '<div class="car-info">';
                    echo '<div class="search-car-date"><h3>' . $info['car_name'] . '</h3>';
                    echo '<div class="separator"></div>';
                    echo '<p>¥' . number_format($info['price']) . '</p>';
                    echo '</div></div>';
                    echo '<div class="button-container">';
                    echo '<button type="button" class="back-button" onclick="location.href=\'search.php\'">戻る</button>';
                    if ($info['stock'] < 1) {
                        echo '<input type="submit" value="在庫切れ" disabled>';
                    } else {
                        echo '<input type="hidden" name="car_id" value="' . $item . '">';
                        echo '<input type="submit" value="購入">';
                    }
                    echo '</div>';
                    $feature = explode(',', $info['car_detail']);
                    echo '<div class="car-detail">';
                    echo '<ul>';
                    foreach ($feature as $row) {
                        echo '<div class="car-syousai"><li>' . $row . '</li></div>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    ?>
                </div>
            </form>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="../js/slide.js"></script>
</body>

</html>