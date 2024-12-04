<?php
require('../header/header.php');
require_once '../DBconnect.php';
$pdo = getDb();

// セッションから user_id を取得
$user_id = $_SESSION['id'] ?? null;

if (!$user_id) {
    echo "ログインしてください。";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // フォームデータを取得
    $user_name = $_POST['user_name'] ?? '';
    $user_mail = $_POST['user_mail'] ?? '';
    $user_password = $_POST['user_password'] ?? '';
    $user_address = $_POST['user_address'] ?? '';

    // 必須項目のチェック
    if (empty($user_name) || empty($user_mail) || empty($user_password) || empty($user_address)) {
        echo "全ての項目を入力してください。";
        exit;
    }

    // データベースを更新
    $sql = "UPDATE user SET user_name = ?, user_mail = ?, user_password = ?, user_address = ? WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$user_name, $user_mail, $user_password, $user_address, $user_id]);

    if ($result) {
        // 更新成功時にリダイレクト
        $_SESSION['name'] = $user_name;
        echo '<script>window.location.href = "edit_success.php";</script>';
        exit;
    } else {
        echo "更新に失敗しました。もう一度お試しください。";
    }
} else {
    echo "無効なリクエストです。";
}
?>
