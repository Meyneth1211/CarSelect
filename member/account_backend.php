<?php
session_start();
require('../header/header.php');
require_once '../DBconnect.php';
$pdo = getDb();

// セッションからログイン中の user_id を取得
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo "ログインしてください。";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // フォームから送信されたデータを取得
    $user_name = $_POST['user_name'] ?? '';
    $user_mail = $_POST['user_mail'] ?? '';
    $user_address = $_POST['user_address'] ?? '';

    // 簡単なバリデーション
    if (empty($user_name) || empty($user_mail) || empty($user_address)) {
        echo "全ての項目を入力してください。";
        exit;
    }

    // ユーザー情報を更新
    $sql = "UPDATE user SET user_name = ?, user_mail = ?, user_address = ? WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$user_name, $user_mail, $user_address, $user_id]);

    if ($result) {
        // 更新成功時
        echo "情報が更新されました。";
        header("Location: edit_success.php"); // 更新成功ページへリダイレクト
        exit;
    } else {
        // 更新失敗時
        echo "更新に失敗しました。";
    }
}
?>
