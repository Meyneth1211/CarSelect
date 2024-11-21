<?php 
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
$pdo = getDb();
?>

<h1>編集画面です！</h1>


    <input type="button" onclick="location.href='car_list'" value="一覧画面へ戻る">
    <input type="button" onclick="location.href='kanrisya_top'" value="トップページへ戻る">
</body>
</html>