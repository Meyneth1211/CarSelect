<?php 
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<h1>在庫管理画面です！</h1>

<?php
// SQLでデータを取得
$sql = $pdo->query('SELECT brand, car_name FROM car');

// 一覧表示用のHTML
echo '<table border="1">';
echo '<tr>
        <th>brand</th>
        <th>car_name</th>
      </tr>';

// 各行のデータを出力
foreach ($sql as $row) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}
echo '</table>';
?>
