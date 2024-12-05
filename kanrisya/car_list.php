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
  <style>
    .brand-buttons {
      margin-bottom: 20px;
      display: flex;
      gap: 10px;
    }
    .brand-button {
      background: none;
      border: none;
      cursor: pointer;
      padding: 5px 10px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: background-color 0.3s, color 0.3s;
    }
    .brand-button:hover {
      background-color: #007bff;
      color: #fff;
    }
    .car-table {
      width: 100%;
      border-collapse: collapse;
    }
    .car-table th, .car-table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }
    .car-table th {
      background-color: #f4f4f4;
    }
    .top-back-button {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<h1 class="page-title">在庫管理画面です！</h1>

<!-- ブランド検索用のボタン -->
<div class="brand-buttons">
  <form method="POST" action="">
    <button type="submit" class="brand-button" name="selectedBrand" value="">全て表示</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="トヨタ">トヨタ</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="マツダ">マツダ</button>
    <button type="submit" class="brand-button" name="selectedBrand" value="レクサス">レクサス</button>
    <!-- 他のブランドを追加 -->
  </form>
</div>

<?php
// POSTリクエストで受け取ったブランド名
$selectedBrand = isset($_POST['selectedBrand']) ? $_POST['selectedBrand'] : null;

// SQLクエリの構築
$sql = 'SELECT car_id, brand, car_name, body_type, color, stock FROM car';
$params = [];

if ($selectedBrand) {
    $sql .= ' WHERE brand = ?';
    $params[] = $selectedBrand;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="page-subtitle">
  <?= htmlspecialchars($selectedBrand ? $selectedBrand . 'の在庫一覧' : '全ての在庫', ENT_QUOTES, 'UTF-8') ?>
</h2>

<!-- 車の在庫一覧表示 -->
<table class="car-table">
  <tr>
    <th>ブランド</th>
    <th>車名</th>
    <th>ボディタイプ</th>
    <th>色</th>
    <th>在庫数</th>
    <th>画像編集</th>
    <th>操作</th>
  </tr>
  <?php if (!empty($cars)): ?>
    <?php foreach ($cars as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['body_type'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8') ?></td>
        <td>
          <form method="POST" action="update_stock.php">
            <input type="number" name="stock" value="<?= htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') ?>" min="0">
            <input type="hidden" name="car_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit">更新</button>
          </form>
        </td>
        <td>
          <form method="GET" action="image_edit.php">
            <button type="submit" name="car_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">画像編集</button>
          </form>
        </td>
        <td>
          <form method="GET" action="car_hensyuu.php">
            <button type="submit" name="edit_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">編集</button>
          </form>
          <form method="POST" action="car_delete_confirm.php">
            <button type="submit" name="delete_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">削除</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="7">該当する在庫がありません。</td></tr>
  <?php endif; ?>
</table>

<div class="top-back-button">
  <button onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>

</body>
</html>