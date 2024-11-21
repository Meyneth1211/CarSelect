<?php 
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<h1 class="page-title">車の在庫一覧</h1>

<?php
// SQLでデータを取得 (stockカラムを追加)
$sql = $pdo->query('SELECT car_id, brand, car_name, color, stock FROM car');

// 一覧表示用のHTML
echo '<form method="post" action="update_stock.php">';
echo '<table class="car-table">';
echo '<tr>
        <th>ブランド</th>
        <th>車名</th>
        <th>色</th>
        <th>在庫数</th>
        <th>操作</th>
      </tr>';

foreach ($sql as $row) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>';
    echo '<input type="number" name="stock[' . $row['car_id'] . ']" value="' . htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') . '" min="0" step="1">';
    echo '</td>';
    echo '<td>';
    // 更新ボタン
    echo '<button class="update-button" type="submit" name="update_stock" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">更新</button>';
    
    // 削除ボタン
    echo '<form style="display: inline;" method="post" action="car_delete.php">';
    echo '<button class="delete-button" type="submit" name="delete_car_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">削除</button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}

echo '</table>';
echo '</form>';

echo '<button class="back-button" onclick="location.href=\'kanrisya_top.php\'">トップページへ戻る</button>';
?>

</body>
</html>
