<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';
$pdo = getDb();

// データベースからuser_id以外の情報を取得
$stmt = $pdo->prepare('SELECT user_name, user_mail, user_password, user_address FROM user');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー情報一覧</title>
</head>
<body>
<div class="container">
    <h1 class="page-title">ユーザー情報一覧</h1>
    <table>
        <thead>
            <tr>
                <th>ユーザー名</th>
                <th>メールアドレス</th>
                <th>パスワード</th>
                <th>住所</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['user_mail'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['user_password'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['user_address'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">ユーザー情報がありません。</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
