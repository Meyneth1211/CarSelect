<?php 
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<h1>ユーザー削除画面です！</h1>

<?php
// 削除ステータスの確認
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo '<p style="color: green;">ユーザーが正常に削除されました。</p>';
    } elseif ($_GET['status'] === 'failure') {
        echo '<p style="color: red;">ユーザーの削除に失敗しました。</p>';
    }
}

// ユーザー一覧の表示
$sql = $pdo->query('SELECT user_name, user_mail, user_address FROM user');
echo '<form method="post" action="user_delete.php">';
echo '<table border="1">';
echo '<tr><th>名前</th><th>メールアドレス</th><th>住所</th><th>ユーザ削除ボタン</th></tr>';
foreach ($sql as $row) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['user_mail'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['user_address'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>';
    echo '<button type="submit" name="delete_user_mail" value="' . htmlspecialchars($row['user_mail'], ENT_QUOTES, 'UTF-8') . '">削除</button>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</form>';
?>
</body>
</html>
