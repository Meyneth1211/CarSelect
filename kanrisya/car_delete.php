<?php
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>
    <div class="container">
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            // 削除するcar_idを取得
            $deleteId = $_POST['delete_id'];

            // 削除クエリを準備
            $deleteSql = $pdo->prepare('DELETE FROM car WHERE car_id = ?');
            $deleteResult = $deleteSql->execute([$deleteId]);

            if ($deleteResult) {
                // 削除成功時
                echo '<div class="message success">商品が正常に削除されました。</div>';
            } else {
                // 削除失敗時
                echo '<div class="message error">商品の削除に失敗しました。</div>';
            }
        } else {
            // 不正なアクセス時の処理
            echo '<p style="color: red;">不正なアクセスです。</p>';
        }
        ?>

        <div class="button-group">
            <input type="button" onclick="location.href='car_list'" value="一覧画面へ戻る">
            <input type="button" onclick="location.href='kanrisya_top'" value="トップページへ戻る">
    </div>
    </div>
</body>
</html>