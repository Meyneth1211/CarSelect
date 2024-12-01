<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品削除確認</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $carId = $_POST['delete_id'];
} else {
    die('<p style="color: red;">不正なアクセスです。</p>');
}
?>

<form action="car_delete.php" method="post">
    <div class="container">
        <div class="message error">この商品を削除しますか？</div>
        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($carId, ENT_QUOTES, 'UTF-8') ?>">
    <div class="button-group">
        <input type="submit" class="delete-confirm-button" name="car-delete" value="削除する">
        <button type="button" class="back-button" onclick="history.back();">戻る</button>
    </div>
    </div>
</form>
</body>
</html>
