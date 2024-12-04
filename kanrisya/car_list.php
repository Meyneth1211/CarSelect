<form method="POST" action="" id="brandFilterForm">
  <div class="checkbox-container">
    <!-- ブランド画像をクリックで送信するボタンに変換 -->
    <button type="button" class="brand-button" onclick="filterByBrand('トヨタ')">
      <img src="../img/Toyota.png" alt="Toyota" width="100px">
    </button>
    <button type="button" class="brand-button" onclick="filterByBrand('マツダ')">
      <img src="../img/Mazda.png" alt="Mazda" width="100px">
    </button>
    <button type="button" class="brand-button" onclick="filterByBrand('レクサス')">
      <img src="../img/Lexus.png" alt="Lexus" width="100px">
    </button>
    <!-- 他のブランドも同様に追加 -->
  </div>
  <!-- 選択したブランドを送信する隠しフィールド -->
  <input type="hidden" name="selectedBrand" id="selectedBrand">
</form>

<script>
  // ブランド画像クリック時の処理
  function filterByBrand(brand) {
    document.getElementById('selectedBrand').value = brand; // 隠しフィールドにブランド名をセット
    document.getElementById('brandFilterForm').submit(); // フォームを送信
  }
</script>

<?php
require('kanrisya_session.php'); 
require_once '../DBconnect.php';
$pdo = getDb();

// クリックされたブランドを取得
$selectedBrand = isset($_POST['selectedBrand']) ? $_POST['selectedBrand'] : null;

// SQLの準備
$sql = 'SELECT car_id, brand, car_name, body_type, color, stock FROM car';
$params = [];

if ($selectedBrand) {
    $sql .= " WHERE brand = ?";
    $params[] = $selectedBrand;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="page-title"><?= htmlspecialchars($selectedBrand ? $selectedBrand . 'の在庫一覧' : '全ての在庫', ENT_QUOTES, 'UTF-8') ?></h1>

<table class="car-table">
  <tr>
    <th>ブランド</th>
    <th>車名</th>
    <th>ボディタイプ</th>
    <th>色</th>
    <th>在庫数</th>
    <th>操作</th>
  </tr>
  <?php if (!empty($cars)): ?>
    <?php foreach ($cars as $row): ?>
      <tr>
        <td class="brand"><?= htmlspecialchars($row['brand'], ENT_QUOTES, 'UTF-8') ?></td>
        <td class="car-name"><?= htmlspecialchars($row['car_name'], ENT_QUOTES, 'UTF-8') ?></td>
        <td class="body_type"><?= htmlspecialchars($row['body_type'], ENT_QUOTES, 'UTF-8') ?></td>
        <td class="color"><?= htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8') ?></td>
        <td class="stock">
          <form method="POST" action="update_stock.php">
            <input type="number" name="stock" value="<?= htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') ?>" min="0">
            <input type="hidden" name="car_id" value="<?= htmlspecialchars($row['car_id'], ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit">更新</button>
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
    <tr><td colspan="6">該当する在庫がありません。</td></tr>
  <?php endif; ?>
</table>