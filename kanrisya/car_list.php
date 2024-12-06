<<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';
$pdo = getDb();

// ブランド名の取得
$selectedBrand = isset($_POST['selectedBrand']) ? $_POST['selectedBrand'] : null;

// SQLクエリ
if ($selectedBrand) {
    $sql = $pdo->prepare('SELECT * FROM car WHERE brand = ?');
    $sql->execute([$selectedBrand]);
} else {
    $sql = $pdo->query('SELECT * FROM car');
}
$cars = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>在庫管理</title>
</head>
<body>
  <h1 class="page-title">在庫管理画面</h1>

  <!-- ブランド選択ボタン -->
  <div class="brand-buttons">
    <form method="POST" action="">
      <button type="submit" name="selectedBrand" value="">全て表示</button>
      <button type="submit" name="selectedBrand" value="トヨタ">トヨタ</button>
      <button type="submit" name="selectedBrand" value="マツダ">マツダ</button>
      <!-- 他のブランドボタン -->
    </form>
  </div>

  <!-- タイトル -->
  <h2 class="page-title">
    <?= htmlspecialchars($selectedBrand ? $selectedBrand . 'の在庫一覧' : '全ての在庫', ENT_QUOTES, 'UTF-8') ?>
  </h2>

  <!-- テーブル表示 -->
  <table class="car-table">
    <tr>
      <th>ブランド</th>
      <th>車名</th>
      <th>ボディタイプ</th>
      <th>色</th>
      <th>在庫数</th>
      <th>操作</th>
    </tr>
    <?php foreach ($cars as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['body_type'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') ?></td>
        <td>
          <!-- 操作ボタン -->
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>