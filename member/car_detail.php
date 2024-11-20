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
            $sql="select image from image where car_id = ? and is_primary = '1'";
            $stmt=$pdo->prepare($sql);
            $stmt->execute([$item]);
            $output=$stmt->fetchall(PDO::FETCH_ASSOC);
            //var_dump($output);
            foreach ($output as $row) {
                echo '<img src="',$row['image'],'">';
            }
            $pdo=null;
        ?>
    </div>
</body>
</html>