<?php
    session_start();
    require('../kanrisya/kanrisya_header.php');
    require_once '../DBconnect.php';
    $pdo = getDb();
    //名前、メアド、パスワード、住所入力しているか確認の処理
    $error = []; //エラー配列作成
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
    

//既に登録されているか確認の処理
echo '<div class="container">';
if (isset($_POST['mail']) && isset($_POST['pass'])) {
    // メールアドレスが登録されているか確認
    $sql = $pdo->prepare('SELECT * FROM admin WHERE admin_mail = ?');
    $sql->execute([$_POST['mail']]);

    // ユーザーが登録されているか確認
    $sql3 = $pdo->prepare('SELECT * FROM admin WHERE admin_mail = ? AND admin_password = ?');
    $sql3->execute([$_POST['mail'], $_POST['pass']]);

    echo '<form action="kanrisya_first_login.php" method="post">';
    if ($sql3->rowCount() > 0) {
        echo '<div class="message success">既に登録されています</div>';
    } elseif ($sql->rowCount() > 0) {
        echo '<div class="message error">そのメールアドレスは既に登録されています</div>';
    } else {
        $sql = $pdo->prepare('INSERT INTO admin (admin_mail, admin_password) VALUES (?, ?)');
        $result = $sql->execute([$_POST['mail'], $_POST['pass']]);
        if ($result) {
            echo '<div class="message success">登録しました</div>';
        } else {
            echo '<div class="message error">登録に失敗しました</div>';
        }
    }
    echo '<input class="nav-button" type="submit" value="ログイン画面へ戻る">';
    echo '</form>';
}
echo '</div>';

       
?>