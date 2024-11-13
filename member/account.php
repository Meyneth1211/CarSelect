<?php
// セッションの開始
session_start();

// データベース接続ファイルをインクルード（例: DBconnect.php）
require_once 'DBconnect.php';
$pdo = getDb();

// ログインしているユーザーのIDをセッションから取得
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // ユーザーのパスワード、メールアドレス、住所を取得
    $sql = "SELECT password, email, address FROM user WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);

    // 結果を取得
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // パスワード、メールアドレス、住所を出力
        echo "パスワード: " . $user['password'] . "<br>";
        echo "メールアドレス: " . $user['email']. "<br>";
        echo "住所: " . $user['address'] . "<br>";
    } else {
        echo "ユーザー情報が見つかりませんでした。";
    }
} else {
    echo "ログインしてください。";
}

$pdo = null;
?>
</body>
</html>