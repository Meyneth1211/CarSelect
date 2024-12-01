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
    <title>削除結果</title>
</head>
<body>
    <div class="container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];

        // 削除クエリを準備
        $deleteSql = $pdo->prepare('DELETE FROM car WHERE car_id = ?');
        $deleteResult = $deleteSql->execute([$deleteId]);

        if ($deleteResult) {
            echo '<div class="message success">商品が正常に削除されました。</div>';
        } else {
            echo '<div class="message error">商品の削除に失敗しました。</div>';
        }
    } else {
        echo '<p style="color: red;">不正なアクセスです。</p>';
    }
    ?>
        <div class="button-group">
            <button class="save-button" onclick="location.href='car_list.php'">一覧画面へ戻る</button>
            <button class="nav-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
        </div>
    </div>
</body>
</html>