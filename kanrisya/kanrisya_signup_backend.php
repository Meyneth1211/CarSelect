<?php
    session_start();
    require('../header/header.php');
    require_once '../DBconnect.php';
    $pdo = getDb();
    //名前、メアド、パスワード、住所入力しているか確認の処理
    $error = []; //エラー配列作成
    echo '<div class="error-back"><div class="error-card">';
    if(empty($_POST['name'])){
        $error[] = '<div class="error-message">名前を入力してください</div>';
    }
    if(empty($_POST['mail'])){
        $error[] = '<div class="error-message">メールアドレスを入力してください</div>';
    }
    if(empty($_POST['pass'])){
        $error[] = '<div class="error-message">パスワードを入力してください</div>';
    }
    foreach($error as $e){
        echo '<p>'.$e.'</p>';
    }
    if(!empty($error)){
        echo '<form class="login-form" action="kanrisya_signup.php" method="post"><input class="button-1" type="submit" value="戻る"></form></div></div>';
        exit;
    }
//既に登録されているか確認の処理
if(isset($_POST['mail']) AND isset($_POST['pass'])){
        //メールアドレスが登録されているか確認
    $sql = $pdo->prepare('SELECT * FROM admin WHERE admin_mail = ?');
    $sql->execute([$_POST['mail']]);
    //ユーザーが登録されているか確認
    $sql3 = $pdo->prepare('SELECT * FROM admin WHERE admin_mail = ? AND admin_password = ?');
    $sql3->execute([$_POST['mail'], $_POST['pass']]);
    echo '<form class="login-form" action="login.php" method="post">';
    if($sql3->rowCount() > 0){
        echo '<div class="error-message">既に登録されています</div>';
        echo '<input class="button-1" type="submit" value="ログイン画面へ戻る">';
    }elseif($sql->rowCount() > 0){
        echo 'そのメールアドレスは既に登録されています。<br>';
        echo '<input class="button-1" type="submit" value="ログイン画面へ戻る">';
    }else{
        $sql = $pdo->prepare('INSERT INTO admin (admin_mail, admin_password) VALUES (?,?)');
        $result = $sql->execute([$_POST['mail'], $_POST['pass']]);
        if($result){
            echo '<div class="error-message">登録しました</div>';
            echo '<input class="button-1" type="submit" value="ログイン画面へ戻る">';
        }
    }
    echo '</form>';
    $pdo = null;
}
       
?>