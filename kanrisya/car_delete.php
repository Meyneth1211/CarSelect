<?php
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        // 削除するcar_idを取得
        $deleteId = $_POST['delete_id'];

        // 削除クエリを準備
        $deleteSql = $pdo->prepare('DELETE FROM car WHERE car_id = ?');
        $deleteResult = $deleteSql->execute([$deleteId]);

        if ($deleteResult) {
            // 削除成功時
            echo '<p style="color: green;">削除完了しました。</p>';
        } else {
            // 削除失敗時
            echo '<p style="color: red;">削除に失敗しました。</p>';
        }
    } else {
        // 不正なアクセス時の処理
        echo '<p style="color: red;">不正なアクセスです。</p>';
    }
    ?>
    
    <input type="button" onclick="location.href='user_list'" value="一覧画面へ戻る">
    <input type="button" onclick="location.href='kanrisya_top'" value="トップページへ戻る">

</body>
</html>