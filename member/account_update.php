<?php
require_once '../DBconnect.php';  // データベース接続を読み込む
$pdo = getDb();

// ユーザーIDをGETパラメータから取得
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // データベースからユーザー情報を取得
    $stmt = $pdo->prepare('SELECT * FROM user WHERE user_id = :user_id');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo '指定されたユーザー情報が見つかりません。';
        exit;
    }
} else {
    echo 'ユーザーIDが指定されていません。';
    exit;
}

// 更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信された情報を取得
    $user_name = $_POST['user_name'];
    $user_mail = $_POST['user_mail'];
    $user_password = $_POST['user_password'];
    $user_address = $_POST['user_address'];

    // データベースを更新
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
        echo 'ユーザー情報が正常に更新されました。';
    } else {
        echo '更新に失敗しました。';
    }
}
?>

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
    <button type="submit">更新</button>
</form>
