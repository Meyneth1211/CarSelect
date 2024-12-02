<?php
session_start();

// ログイン状態を確認
if (!isset($_SESSION['id'])) {
    // セッションに user_id がない場合は未ログイン状態
    header('Location: login.php'); // ログインページにリダイレクト
    exit;
}
?>
