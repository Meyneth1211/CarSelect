<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';
$pdo = getDb();


if($_POST['send']){
//フォームからのデータ取得
$car_name = $_POST['car_name'];
$brand = $_POST['brands'];
$body_type = $_POST['body-type'];
$price = $_POST['insert-price'];
$car_detail = $_POST['insert-detail'];
$color = $_POST['color'];


//エラーメッセージの表示
$errors = [];
if (!$car_name) $errors[] = '車名を入力してください。';
if (!$brand) $errors[] = 'メーカーを選択してください。';
if (!$body_type) $errors[] = 'ボディタイプを選択してください。';
if (!$price || !is_numeric($price)) $errors[] = '値段を正しく入力してください。';
if (!$color) $errors[] = '色を選択してください。';

if ($errors) {
    // エラーメッセージを表示する！
    foreach ($errors as $error) {
        echo '<p style="color: red;">' . htmlspecialchars($error) . '</p>';
    }
    exit();
}

$stmt = $pdo->prepare('INSERT INTO cars (car_name, brand, body_type, price, car_detail, color) VALUES (?,?,?,?,?,?)');
$result = $stmt->execute([$car_name,$brand,$body_type,$price,$car_detail,$color]);
$pdo = null;

if($result){
    echo '<h2>商品の登録が完了しました。</h2>';
    echo '<button type="button" onclick="location.href="https://aso2301389.hippy.jp/carselect/kanrisya/kanrisya_insert/"">続けて登録する</button>';
}else{
    echo '<h2>商品の登録に失敗しました。</h2>';
    echo '<button type="button" onclick="location.href="https://aso2301389.hippy.jp/carselect/kanrisya/kanrisya_insert/"">再度登録する</button>';
}
}
?>