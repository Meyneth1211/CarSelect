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
    if(empty($_POST['mail'])){
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
//既に登録されているか確認の処理
if(isset($_POST['name']) AND isset($_POST['mail']) AND isset($_POST['pass'])){
        //メールアドレスが登録されているか確認
    $sql = $pdo->prepare('SELECT * FROM user WHERE user_mail = ?');
    $sql->execute([$_POST['mail']]);
    //名前が登録されているか確認
    $sql2 = $pdo->prepare('SELECT * FROM user WHERE user_name = ?');
    $sql2->execute([$_POST['name']]);
    //ユーザーが登録されているか確認
    $sql3 = $pdo->prepare('SELECT * FROM user WHERE user_mail = ? AND user_password = ? AND user_name = ?');
    $sql3->execute([$_POST['mail'], $_POST['pass'], $_POST['name']]);
    if($sql3->rowCount() > 0){
        echo '既に登録されています。<br>';
        echo '<a href="login.php">ログイン画面へ戻る</a>';
    }elseif($sql2->rowCount() > 0){
        echo 'その名前は既に使われています。<br>';
        echo '<a href="login.php">ログイン画面へ戻る</a>';
    }elseif($sql->rowCount() > 0){
        echo 'そのメールアドレスは既に登録されています。<br>';
        echo '<a href="login.php">ログイン画面へ戻る</a>';
    }else{
        $sql = $pdo->prepare('INSERT INTO user (user_mail, user_password, user_name, user_address) VALUES (?,?,?,?)');
        $result = $sql->execute([$_POST['mail'], $_POST['pass'], $_POST['name'], $_POST['address']]);
        if($result){
            echo '登録しました。<br>';
            echo '<a href="login.php">ログイン画面へ戻る</a>';
        }
    }
    $pdo = null;
}
       
?>