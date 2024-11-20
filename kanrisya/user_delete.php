<?php 
    require('kanrisya_header.php'); 
    require_once '../DBconnect.php';
    $pdo = getDb();
?>

<h1>ユーザー削除画面です！</h1>

<?php
    $sql = $pdo->query('SELECT user_name, user_mail, user_address FROM user');
    echo '<table border="1">';
    echo '<tr><th>名前</th><th>メールアドレス</th><th>住所</th></tr>';
    foreach ($sql as $row) {
        echo '<tr>';
        echo '<td>' . $row['user_name'] . '</td>';
        echo '<td>' . $row['user_mail'] . '</td>';
        echo '<td>' . $row['user_address'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>
?>
</body>
</html>