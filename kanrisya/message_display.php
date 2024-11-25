<?php 
session_start();
require('kanrisya_header.php');

// メッセージが存在する場合に表示
if (isset($_SESSION['delete_message'])): ?>
    <div class="message success">
        <?= $_SESSION['delete_message'] ?>
    </div>
    <?php unset($_SESSION['delete_message']); ?> <!-- メッセージを表示後にセッションから削除 -->
<?php else: ?>
    <div class="message error">
        削除完了のメッセージがありません。
    </div>
<?php endif; ?>

<div class="top-back-button">
    <button class="back-button" onclick="location.href='kanrisya_top.php'">トップページへ戻る</button>
</div>
