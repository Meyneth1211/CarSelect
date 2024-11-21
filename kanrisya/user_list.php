<?php 
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<h1 class="page-title">ユーザー削除画面です！</h1>

<?php
        // ユーザー一覧の表示
        $sql = $pdo->query('SELECT user_name, user_mail, user_address FROM user');
        echo '<form method="post" action="user_delete.php">';
        echo '<table class="user-table">';
        echo '<tr><th>名前</th><th>メールアドレス</th><th>住所</th><th>操作</th></tr>';
        foreach ($sql as $row) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['user_mail'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['user_address'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>';
            echo '<button class="delete-button" type="submit" name="delete_user_mail" value="' . htmlspecialchars($row['user_mail'], ENT_QUOTES, 'UTF-8') . '">削除</button>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
        ?>
        <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
    </div>
</body>
</html>