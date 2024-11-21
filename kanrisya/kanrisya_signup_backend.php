<?php
    session_start();
    require('../kanrisya/kanrisya_header.php');
    require_once '../DBconnect.php';
    $pdo = getDb();
    //名前、メアド、パスワード、住所入力しているか確認の処理
    $error = []; //エラー配列作成
    echo '<div class="container">';
    if(empty($_POST['mail'])){
        $error[] = '<div class="message success">メールアドレスを入力してください</div>';
    }
    if(empty($_POST['pass'])){
        $error[] = '<div class="message success">パスワードを入力してください</div>';
    }
    foreach($error as $e){
        echo '<p>'.$e.'</p>';
    }
    if(!empty($error)){
        echo '<form class="nav-button" action="kanrisya_signup.php" method="post"><input class="nav-button" type="submit" value="戻る"></form>';
        exit;
    }
    echo '</div>';

//既に登録されているか確認の処理
echo '<div class="container">';
if(isset($_POST['mail']) AND isset($_POST['pass'])){
        //メールアドレスが登録されているか確認
    $sql = $pdo->prepare('SELECT * FROM admin WHERE admin_mail = ?');
    $sql->execute([$_POST['mail']]);
    //ユーザーが登録されているか確認
    $sql3 = $pdo->prepare('SELECT * FROM admin WHERE admin_mail = ? AND admin_password = ?');
    $sql3->execute([$_POST['mail'], $_POST['pass']]);
    echo '<form action="kanrisya_login.php" method="post">';
    if($sql3->rowCount() > 0){
        echo '<div class="message success">既に登録されています</div>';
        echo '<input class="nav-button" type="submit" value="ログイン画面へ戻る">';
    }elseif($sql->rowCount() > 0){
        echo '<div class="message success">そのメールアドレスは既に登録されています</div>';
        echo '<input class="nav-button" type="submit" value="ログイン画面へ戻る">';
    }else{
        $sql = $pdo->prepare('INSERT INTO admin (admin_mail, admin_password) VALUES (?,?)');
        $result = $sql->execute([$_POST['mail'], $_POST['pass']]);
        if($result){
            echo '<div class="message success">登録しました</div>';
            echo '<input class="nav-button" type="submit" value="ログイン画面へ戻る">';
        }
    }
    
    echo '</form>';
    echo '</div>';
    $pdo = null;
}
       
?>