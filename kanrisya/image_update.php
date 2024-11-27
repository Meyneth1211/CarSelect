<?php require('kanrisya_header.php'); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品画像更新画面</title>
</head>
<body>
<form action="../kanrisya/image_update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car_id, ENT_QUOTES, 'UTF-8') ?>">
    
    <h1 class="page-title">画像一覧</h1>

    <table class="image-table">
        <tr>
            <td class="label-cell">メイン画像</td>
            <td class="image-cell">
                <?php foreach ($images as $row): ?>
                    <?php if ($row['is_primary'] == 1): ?>
                        <label class="image-checkbox">
                            <input type="checkbox" name="selected_images[]" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>" hidden>
                            <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="メイン画像" class="car-image">
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <td class="label-cell">サブ画像</td>
            <td class="image-cell">
                <?php foreach ($images as $row): ?>
                    <?php if ($row['is_primary'] == 0): ?>
                        <label class="image-checkbox">
                            <input type="checkbox" name="selected_images[]" value="<?= htmlspecialchars($row['image_id'], ENT_QUOTES, 'UTF-8') ?>" hidden>
                            <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="サブ画像" class="car-image">
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>

    <h2>新しい画像をアップロード</h2>
    <input type="file" name="new_images[]" multiple>
    
    <div class="top-back-button">
        <button type="submit" class="updateButton">画像を更新する</button>
        <button type="button" class="back-button" onclick="location.href='car_list.php'">商品一覧へ戻る</button>
    </div>
</form>