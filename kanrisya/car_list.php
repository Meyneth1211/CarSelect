<?php 
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<h1 class="page-title">在庫管理画面です！</h1>

<?php

// SQLでデータを取得 (stockカラムを追加)
$sql = $pdo->query('SELECT car_id, brand, car_name, color, stock FROM car');

// 一覧表示用のHTML
echo '<table class="car-table">';
echo '<tr>
        <th>ブランド</th>
        <th>車名</th>
        <th>色</th>
        <th>在庫数</th>
        <th>操作</th>
      </tr>';

// 各行のデータを出力
foreach ($sql as $row) {
    echo '<tr>';
    echo '<td class="brand">' . htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="car-name">' . htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="color">' . htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="stock">' . htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="actions">';
    
    // ステッパーで在庫数を変更するフォーム
    echo '<form class="stock-update-form" style="display: inline;" method="post" action="update_stock.php">';
    echo '<input type="number" class="stock-input" name="stock" value="' . htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') . '" min="0" step="1"> ';
    echo '<input type="hidden" name="car_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">';
    echo '<button class="update-button" type="submit">在庫更新</button>';
    echo '</form> ';

    // 編集ボタン
    echo '<form class="edit-form" style="display: inline;" method="get" action="zaiko_hensyuu.php">';
    echo '<button class="edit-button" type="submit" name="edit_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">編集</button>';
    echo '</form> ';
    
    // 削除ボタン
    echo '<form class="delete-form" style="display: inline;" method="post" action="car_delete.php">';
    echo '<button class="delete-button" type="submit" name="delete_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">削除</button>';
    echo '</form>';
    
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
?>
<div class="top-back-button">
  <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>
