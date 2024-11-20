<?php 
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<h1>ユーザー削除画面です！</h1>

<?php
// INSERT: ユーザー情報の追加処理（例）
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = $pdo->prepare('INSERT INTO user (user_mail, user_password, user_name, user_address) VALUES (?,?,?,?)');
    $result = $sql->execute([$_POST['mail'], $_POST['pass'], $_POST['name'], $_POST['address']]);
    if ($result) {
        echo '<p>ユーザーが正常に追加されました。</p>';
    } else {
        echo '<p>ユーザーの追加に失敗しました。</p>';
    }
}

// SELECT: ユーザー情報を取得して表示
$sql = $pdo->query('SELECT user_name, user_mail, user_address FROM user');
echo '<table border="1">';
echo '<tr><th>名前</th><th>メールアドレス</th><th>住所</th></tr>';
foreach ($sql as $row) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['user_mail'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['user_address'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}
echo '</table>';
?>
</body>
</html>
