<?php 
require('kanrisya_session.php'); 
require_once '../DBconnect.php';

$pdo = getDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $is_primary = isset($_POST['is_primary']) ? 1 : 0;

    // メイン画像は1枚制限
    if ($is_primary == 1) {
        $pdo->prepare('UPDATE image SET is_primary = 0 WHERE car_id = ?')->execute([$car_id]);
    }

    // ファイルアップロード処理
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];

        // アップロードディレクトリを絶対パスで指定
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        $uploadPath = $uploadDir . basename($fileName);

        // ディレクトリが存在するか確認
        if (!is_dir($uploadDir)) {
            die('アップロード用のディレクトリが存在しません。');
        }

        // ディレクトリに書き込み権限があるか確認
        if (!is_writable($uploadDir)) {
            die('アップロード用のディレクトリに書き込み権限がありません。');
        }

        // ファイルをアップロード
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // 画像データをデータベースに保存
            $sql = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?, ?, ?)');
            $sql->execute([$car_id, $uploadPath, $is_primary]);
        } else {
            die('画像のアップロードに失敗しました。');
        }
    } else {
        // アップロードエラーがあった場合
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            die('ファイルのアップロードに失敗しました。エラーコード: ' . $_FILES['image']['error']);
        }
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
