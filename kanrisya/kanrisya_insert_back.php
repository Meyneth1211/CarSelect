<?php
require('kanrisya_session.php');
require_once '../DBconnect.php';
$pdo = getDb();

if ($_POST['send']) {
    // フォームからのデータ取得
    $car_name = $_POST['car_name'];
    $brand = $_POST['brands'];
    $body_type = $_POST['body-type'];
    $price = $_POST['insert-price'];
    $car_detail = $_POST['insert-detail'];
    $color = $_POST['color'];

    // エラーメッセージの確認
    $errors = [];
    if (!$car_name) $errors[] = '車名を入力してください。';
    if (!$brand) $errors[] = 'メーカーを選択してください。';
    if (!$body_type) $errors[] = 'ボディタイプを選択してください。';
    if (!$price || !is_numeric($price)) $errors[] = '値段を正しく入力してください。';
    if (!$color) $errors[] = '色を選択してください。';

    if ($errors) {
        // エラーメッセージを表示
        foreach ($errors as $error) {
            echo '<p style="color: red;">' . htmlspecialchars($error) . '</p>';
        }
        exit();
    }

    // `car` テーブルにデータを挿入
    $stmt = $pdo->prepare('INSERT INTO car (car_name, brand, body_type, price, car_detail, color) VALUES (?,?,?,?,?,?)');
    $result = $stmt->execute([$car_name, $brand, $body_type, $price, $car_detail, $color]);

    if ($result) {
        // 挿入した `car_id` を取得
        $car_id = $pdo->lastInsertId();//lastInsertId()で直近でAUTO_INCREMENTされた主キーの値を取得する！

        // アップロードディレクトリの指定
        $uploadDir = '../img/detail/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // メイン画像の処理
        if (!empty($_FILES['main_image']['name'])) {
            $mainImageName = uniqid() . '_' . basename($_FILES['main_image']['name']);
            $mainImagePath = $uploadDir . $mainImageName;

            if (move_uploaded_file($_FILES['main_image']['tmp_name'], $mainImagePath)) {
                $stmt = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?,?,1)');
                $stmt->execute([$car_id, $mainImagePath]);
            } else {
                echo '<p style="color: red;">メイン画像のアップロードに失敗しました。</p>';
            }
        }

        // その他の画像の処理
        if (!empty($_FILES['other_images']['name'][0])) {
            foreach ($_FILES['other_images']['name'] as $key => $otherImageName) {
                $tmpName = $_FILES['other_images']['tmp_name'][$key];
                $otherName = uniqid() . '_' . basename($otherImageName);
                $otherImagePath = $uploadDir . $otherName;

                if (move_uploaded_file($tmpName, $otherImagePath)) {
                    $stmt = $pdo->prepare('INSERT INTO image (car_id, image, is_primary) VALUES (?,?,0)');
                    $stmt->execute([$car_id, $otherImagePath]);
                } else {
                    echo '<p style="color: red;">その他の画像のアップロードに失敗しました: ' . htmlspecialchars($otherImageName) . '</p>';
                }
            }
        }

        echo '<h2>商品の登録が完了しました。</h2>';
        echo '<button type="button" onclick="location.href=\'https://aso2301389.hippy.jp/carselect/kanrisya/kanrisya_insert.php\'">続けて登録する</button>';
    } else {
        echo '<h2>商品の登録に失敗しました。</h2>';
    }

    $pdo = null;
}