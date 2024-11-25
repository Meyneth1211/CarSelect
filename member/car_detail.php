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

    <div class="car_image">
        <?php
            //GETメソッドによる値受け渡し
            //URLのクエリパラメータからitemという変数名で車IDを取得
            $item=$_GET['item'];
            //DB接続し前述の車IDに一致する画像のURLを取得
            require_once '../DBconnect.php';
            $pdo=getDB();
            $sql="SELECT COUNT(*) FROM image WHERE car_id = ?";
            //$sql="SELECT image FROM image WHERE car_id = ? ORDER BY is_primary DESC";
            $stmt=$pdo->prepare($sql);
            $stmt->execute([$item]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            $count=$result['count(*)'];
            echo '<h2>行数：'. $count .'</h2>';
            $pdo=null;
        ?>
    </div>
</body>
</html>