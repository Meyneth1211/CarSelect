<?php
    session_start();
    require('../header/header.php');
    require_once '../DBconnect.php';
    $pdo = getDb();
    //名前、メアド、パスワード、住所入力しているか確認の処理
    $error = []; //エラー配列作成
    if(empty($_POST['name'])){
        $error[] = '名前を入力してね！';
    }
    if(empty($_POST['email'])){
        $error[] = 'メールアドレスを入力してね！';
    }
    if(empty($_POST['pass'])){
        $error[] = 'パスワードを入力してね！';
    }
    if(empty($_POST['address'])){
        $error[] = '住所を入力してね！';
    }
    foreach($error as $e){
        echo '<p>'.$e.'</p>';
    }
    if(!empty($error)){
        echo '<a href="signup.php">会員登録画面へ戻る</a>';
        exit;
    }
?>