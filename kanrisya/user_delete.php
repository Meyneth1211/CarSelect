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
    <title>ユーザー削除処理</title>
</head>
<body>
<div class="container">
    <h1 class="page-title">ユーザー削除処理</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_mail'])) {
        $deleteMail = $_POST['delete_user_mail'];

        // ユーザー削除クエリ
        $deleteSql = $pdo->prepare('DELETE FROM user WHERE user_mail = ?');
        $deleteResult = $deleteSql->execute([$deleteMail]);

        if ($deleteResult) {
            echo '<div class="message success">ユーザーが正常に削除されました。</div>';
        } else {
            echo '<div class="message error">ユーザーの削除に失敗しました。</div>';
        }
    } else {
        echo '<p style="color: red;">不正なアクセスです。</p>';
    }
    ?>

    <div class="button-group">
        <button class="nav-button" onclick="location.href='user_list.php'">一覧画面へ戻る</button>
        <button class="nav-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
    </div>
</div>
</body>
</html>