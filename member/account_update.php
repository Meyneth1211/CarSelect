<?php
require('account_session.php'); // ユーザーセッション確認
require_once '../DBconnect.php'; // DB接続ファイル

$pdo = getDb();

// 編集対象のuser_idを取得
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // データベースから該当ユーザーの情報を取得
    $stmt = $pdo->prepare('SELECT user_name, user_mail, user_password, user_address FROM user WHERE user_id = :user_id');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo '<p>指定されたユーザーの情報が見つかりません。</p>';
        exit;
    }
} else {
    echo '<p>ユーザーIDが指定されていません。</p>';
    exit;
}

// 更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $user_mail = $_POST['user_mail'];
    $user_password = $_POST['user_password'];
    $user_address = $_POST['user_address'];

    // 入力されたデータを更新
    $update_stmt = $pdo->prepare('
        UPDATE user 
        SET user_name = :user_name, user_mail = :user_mail, 
            user_password = :user_password, user_address = :user_address
        WHERE user_id = :user_id
    ');
    $update_stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $update_stmt->bindValue(':user_mail', $user_mail, PDO::PARAM_STR);
    $update_stmt->bindValue(':user_password', $user_password, PDO::PARAM_STR);
    $update_stmt->bindValue(':user_address', $user_address, PDO::PARAM_STR);
    $update_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        echo '<p>ユーザー情報が正常に編集されました。</p>';
        echo '<a href="account.php">アカウント画面に戻る</a>';
        exit;
    } else {
        echo '<p>更新が失敗しました。</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー情報編集</title>
</head>
<body>
    <h1>ユーザー情報編集</h1>
    <form method="post">
        <table>
            <tr>
                <th>名前</th>
                <td><input type="text" name="user_name" value="<?= htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8') ?>" required></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td><input type="email" name="user_mail" value="<?= htmlspecialchars($user['user_mail'], ENT_QUOTES, 'UTF-8') ?>" required></td>
            </tr>
            <tr>
                <th>パスワード</th>
                <td><input type="password" name="user_password" value="<?= htmlspecialchars($user['user_password'], ENT_QUOTES, 'UTF-8') ?>" required></td>
            </tr>
            <tr>
                <th>住所</th>
                <td><input type="text" name="user_address" value="<?= htmlspecialchars($user['user_address'], ENT_QUOTES, 'UTF-8') ?>" required></td>
            </tr>
        </table>
        <button type="submit">更新確定</button>
        <button type="button" onclick="location.href='account.php'">キャンセル</button>
    </form>
</body>
</html>
