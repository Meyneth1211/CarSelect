<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>在庫管理</title>
</head>
<body>
  <h1 class="paji-title">在庫管理画面</h1>

<div class="brand-buttons">
  <form method="POST" action="">
    <button type="submit" class="brand-button" name="selectedBrand" value="">全て表示</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="トヨタ">トヨタ</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="マツダ">マツダ</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="ホンダ">ホンダ</button>    
    <button type="submit" class="brand-button" name="selectedBrand" value="日産">日産</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="ポルシェ">ポルシェ</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="フェラーリ">フェラーリ</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="ランボルギーニ">ランボルギー二</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="BMW">BMW</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="ベンツ">ベンツ</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="レクサス">レクサス</button>
  </form>
</div>
</body>
</html>

<?php

// postで受け取ったブランド名がNULLなら全て表示、NULLでない場合そのブランドの在庫を表示する
if(isset($_POST['selectedBrand']) == null){
$slectedBrand = isset($_POST['selectedBrand']);  
$sql = $pdo->prepare('select from car where car_name = ?');
$sql->execute([$slectedBrand]);
}else{
  $stmt = $pdo->query("SELECT * FROM car");
  $spl = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2 class="page-title">
  <?= htmlspecialchars($slectedBrand ? $slectedBrand . 'の在庫一覧' : '全ての在庫',ENT_QUOTES, 'UTF-8')?>
</h2>

<?php
// 一覧表示用のHTML
echo '<table class="car-table">';
echo '<tr>
        <th>ブランド</th>
        <th>車名</th>
        <th>ボディタイプ</th>
        <th>色</th>
        <th>在庫数</th> <!-- Stock column header -->
        <th>画像</th> <!-- 画像カラム -->
        <th>操作</th>
      </tr>';

// 各行のデータを出力
foreach ($sql as $row) {
    echo '<tr>';
    echo '<td class="brand">' . htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="car-name">' . htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="body_type">' . htmlspecialchars($row['body_type'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="color">' . htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8') . '</td>';
    
    // 在庫数の入力フォーム
    echo '<td class="stock">';
    echo '<form class="stock-update-form" style="display: inline;" method="post" action="update_stock.php">';
    echo '<input type="number" class="stock-input" name="stock" value="' . htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') . '" min="0" step="1"> ';
    echo '<input type="hidden" name="car_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">';
    echo '<button class="update-button" type="submit">在庫更新</button>';
    echo '</form>';
    echo '</td>';

    // 画像編集ボタン
    echo '<td class="edit-form">';
    echo '<form class="edit-form" style="display: inline;" method="get" action="image_edit.php">';
    echo '<button class="edit-button" type="submit" name="car_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">画像編集</button>';
    echo '</form>';
    echo '</td>';

    echo '<td class="actions">';
    
    // 編集ボタン
    echo '<form class="edit-form" style="display: inline;" method="get" action="car_hensyuu.php">';
    echo '<button class="edit-button" type="submit" name="edit_id" value="' . htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') . '">編集</button>';
    echo '</form> ';
    
    // 削除ボタン
    echo '<form class="delete-form" style="display: inline;" method="post" action="car_delete_confirm.php">';
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
