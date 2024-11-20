<?php
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_mail'])) {
    $deleteMail = $_POST['delete_user_mail'];
    $deleteSql = $pdo->prepare('DELETE FROM user WHERE user_mail = ?');
    $deleteResult = $deleteSql->execute([$deleteMail]);

    if ($deleteResult) {
        // 削除成功時にフラグを付けてリダイレクト
        header('Location: user_list.php?status=success');
    } else {
        // 削除失敗時にフラグを付けてリダイレクト
        header('Location: user_list.php?status=failure');
    }
    exit();
}
?>
