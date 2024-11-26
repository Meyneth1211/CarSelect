<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>車の詳細 - Car Select</title>
</head>
<body>
    <!-- ヘッダ呼び出し -->
    <?php require('../header/header.php'); ?>

    <div class="car-image">
        <?php
            //GETメソッドによる値受け渡し
            //URLのクエリパラメータからitemという変数名で車IDを取得
            $item=$_GET['item'];
            require_once '../DBconnect.php';
            $pdo=getDB();
            $sql="SELECT COUNT(*) FROM image WHERE car_id = ?";
            //$sql="SELECT image FROM image WHERE car_id = ? ORDER BY is_primary DESC";
            $stmt=$pdo->prepare($sql);
            $stmt->execute([$item]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            $count=$result['COUNT(*)'];
            //echo '<h2>行数：'. $count .'</h2>';
            echo '<ul class="slider">';
                for ($i=1; $i <= $count; $i++) { 
                    echo '<li class="slider-item slider-item'. $i .'"></li>';
                }
            echo '</ul>';
        ?>
    </div>
    <div class="car-info">
        <?php
            $sql='SELECT * FROM car WHERE car_id = ?';
            $stmt=$pdo->prepare($sql);
            $stmt->execute([$item]);
            $info=$stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($info);
        ?>
    </div>
</body>
</html>