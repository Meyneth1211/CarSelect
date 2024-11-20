<?php
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();

// 削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_mail'])) {
    $deleteMail = $_POST['delete_user_mail'];
    $deleteSql = $pdo->prepare('DELETE FROM user WHERE user_mail = ?');
    $deleteResult = $deleteSql->execute([$deleteMail]);
    if ($deleteResult) {
        echo '<div><p>ユーザーが正常に削除されました。</p></div>';
    } else {
        echo '<div><p>ユーザーの削除に失敗しました。</p></div>';
    }
}
?>
<input type="button" onclick="location.href='user_list'" value="一覧画面へ戻る">
<input type="button" onclick="location.href='kanrisya_top'" value="トップページへ戻る">

</body>
</html>
