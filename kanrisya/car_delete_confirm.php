<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品削除確認</title>
    <style></style>
</head>
<body>
    <form action="car_delete.php" method="post">
        <div class="container">
            <div class="message success">
                この商品を削除しますか？
            </div>
            <input type="submit" name="car-delete" value="削除する">
            <button type="button" onclick="history.back();">戻る</button>
        </div>
    </form>
</body>
</html>