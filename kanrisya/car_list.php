<?php 
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<h1>在庫管理画面です！</h1>

<?php

// SQLでデータを取得
$sql = $pdo->query('SELECT car_id, brand, car_name, color FROM car'); // car_idも取得

// 一覧表示用のHTML
echo '<h1>車のブランドと名前一覧</h1>';
echo '<table border="1">';
echo '<tr>
        <th>brand</th>
        <th>car_name</th>
        <th>color</th>
        <th>操作</th>
      </tr>';

// 各行のデータを出力
foreach ($sql as $row) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>';
    // 編集ボタン
    echo '<form style="display: inline;" method="get" action="zaiko_hensyuu.php">';
    echo '<button type="submit" name="edit_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">編集</button>';
    echo '</form> ';
    // 削除ボタン
    echo '<form style="display: inline;" method="post" action="car_delete.php">';
    echo '<button type="submit" name="delete_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">削除</button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
?>

