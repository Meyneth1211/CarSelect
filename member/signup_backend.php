<?php
    session_start();
    require('../header/header.php');
    require_once '../DBconnect.php';
    $pdo = getDb();
    $error = []; //エラー配列作成
    if(empty($_POST['name'])){
        $error[] = '名前を入力してください';
    }
    if(empty($_POST['email'])){
        $error[] = 'メールアドレスを入力してください';
    }
    if(empty($_POST['pass'])){
        $error[] = 'パスワードを入力してください';
    }
    if(empty($_POST['address'])){
        $error[] = '住所を入力してください';
    }
?>