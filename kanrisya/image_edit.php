<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';
$pdo = getDb();

// car_idの取得を試みる
if (isset($_GET['car_id']) && is_numeric($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
} else {
    // エラー時の処理: メッセージを表示してトップページへ戻る
    echo '<p>車両IDが指定されていません。</p>';
    echo '<div class="top-back-button">';
    echo '<button class="back-button" onclick="location.href=\'kanrisya_top.php\'">トップページへ戻る</button>';
    echo '</div>';
    exit;
}

// 該当するcar_idの画像データを取得
$sql = $pdo->prepare('SELECT * FROM image WHERE car_id = :car_id');
$sql->execute([':car_id' => $car_id]);
$images = $sql->fetchAll();

if (!$images) {
    echo '<p>指定された車両に関連する画像が見つかりません。</p>';
    echo '<div class="top-back-button">';
    echo '<button class="back-button" onclick="location.href=\'kanrisya_top.php\'">トップページへ戻る</button>';
    echo '</div>';
    exit;
}
?>

<h1 class="page-title">画像表示画面</h1>

<!-- 車両IDの表示 -->
<p><strong>対象車両ID:</strong> <?php echo htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8'); ?></p>

<!-- 画像一覧の表示 -->
<table class="image-table">
    <tr>
        <th>image_id</th>
        <th>画像</th>
        <th>メイン画像</th>
    </tr>
    <?php foreach ($images as $image): ?>
    <tr>
        <td><?php echo htmlspecialchars($image['image_id'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td>
            <img src="<?php echo htmlspecialchars($image['image'], ENT_QUOTES, 'UTF-8'); ?>" 
                 alt="車両画像" 
                 width="200" 
                 height="auto">
        </td>
        <td><?php echo $image['is_primary'] == 1 ? 'はい' : 'いいえ'; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="top-back-button">
    <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>
