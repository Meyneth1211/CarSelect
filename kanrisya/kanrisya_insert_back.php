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
$color = $_POST['color'] ?? null;

// アップロードされたファイルを処理
if (!empty($_FILES['images']['name'][0])) {
    $uploadDir = 'uploads/'; // 保存先ディレクトリ
    $errors = [];
    $uploadedFiles = [];

foreach ($_FILES['images']['name'] as $key => $imageName) {
        $tmpName = $_FILES['images']['tmp_name'][$key];
        $fileSize = $_FILES['images']['size'][$key];
        $fileError = $_FILES['images']['error'][$key];
        $fileType = $_FILES['images']['type'][$key];

        // ファイルを保存
        $newFileName = uniqid() . '_' . basename($imageName); // 一意の名前を生成
        $destination = $uploadDir . $newFileName;

if (move_uploaded_file($tmpName, $destination)) {
    // データベースに保存
    $stmt = $pdo->prepare('INSERT INTO images (file_path) VALUES (:file_path)');
    $stmt->execute([':file_path' => $destination]);
    $uploadedFiles[] = $destination;
} else {
    $errors[] = "$imageName のアップロードに失敗しました。";
}
}



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
}

$stmt = $pdo->prepare('INSERT INTO car (car_name, brand, body_type, price, car_detail, color) VALUES (?,?,?,?,?,?)');
$result = $stmt->execute([$car_name,$brand,$body_type,$price,$car_detail,$color]);
$pdo = null;

if($result){
    echo '<button type="button" onclick="redirectToInsert()">続けて登録する</button>';
    echo '<script>
    function redirectToInsert() {
        window.location.href = "https://aso2301389.hippy.jp/carselect/kanrisya/kanrisya_insert.php";
    }
    </script>';
}else{
    echo '<button type="button" onclick="redirectToInsert()">続けて登録する</button>';
    echo '<script>
    function redirectToInsert() {
        window.location.href = "https://aso2301389.hippy.jp/carselect/kanrisya/kanrisya_insert.php";
    }
    </script>';
}
}else{
    echo '商品の登録に失敗しました。';
}
?>