<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';
$pdo = getDb();

// ブランド名の取得
$selectedBrand = isset($_POST['selectedBrand']) ? $_POST['selectedBrand'] : null;
// postで受け取ったブランド名がNULLなら全て表示、NULLでない場合そのブランドの在庫を表示する
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
  <style>
     .list-brand-button {
      background: none;
      border: none;
      cursor: pointer;
      padding: 5px 10px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: background-color 0.3s, color 0.3s;
      margin: 0 20px;
     }

     .brand-buttons{
      text-align: center;
     }

     .list-brand-button:hover {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>
  <h1 class="page-title">在庫管理画面</h1>

  <!-- ブランド選択ボタン -->
  <div class="brand-buttons">
    <form method="POST" action="">
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="">全て表示</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="トヨタ">トヨタ</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="マツダ">マツダ</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="ホンダ">ホンダ</button>    
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="日産">日産</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="ポルシェ">ポルシェ</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="フェラーリ">フェラーリ</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="ランボルギーニ">ランボルギー二</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="BMW">BMW</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="ベンツ">ベンツ</button>
      <button type="submit"  class="list-brand-button" name="selectedBrand" value="レクサス">レクサス</button>
    </form>
  </div>

  <!-- タイトル -->
  <h2 class="page-title">
    <?= htmlspecialchars($selectedBrand ? $selectedBrand . 'の在庫一覧' : '全ての在庫一覧', ENT_QUOTES, 'UTF-8') ?>
  </h2>

  <!-- テーブル表示 -->
  <table class="car-table" border="1">
    <tr>
      <th>ブランド</th>
      <th>車名</th>
      <th>ボディタイプ</th>
      <th>色</th>
      <th>在庫数</th>
      <th>画像編集</th>
      <th>操作</th>
    </tr>
    <?php foreach ($cars as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['body_type'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8') ?></td>
        <td>
          <form method="post" action="update_stock.php" style="display: inline;">
            <input type="number" class="stock-input" name="stock" value="<?= htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') ?>" min="0" step="1">
            <input type="hidden" name="car_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit" class="update-button">在庫更新</button>
          </form>
        </td>
        <td>
          <form method="get" action="image_edit.php" style="display: inline;">
            <button type="submit" class="edit-button" name="car_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">画像編集</button>
          </form>
        </td>
        <td>
          <form method="get" action="car_hensyuu.php" style="display: inline;">
            <button type="submit" class="edit-button" name="edit_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">編集</button>
          </form>
          <form method="post" action="car_delete_confirm.php" style="display: inline;">
            <button type="submit" class="delete-button" name="delete_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">削除</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <div class="top-back-button">
    <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
  </div>
</body>
</html>