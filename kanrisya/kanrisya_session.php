<?php 
    session_start();
    require_once '../DBconnect.php';
    $pdo = getDb();

    //メールアドレスとパスワードが入力されているか確認
    if(!empty($_POST['mail'])&&!empty($_POST['pass'])){
        $sql=$pdo->prepare('SELECT * from admin where admin_mail=? and admin_password=?');
        $sql->execute([$_POST['mail'],$_POST['pass']]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // ユーザーが存在する場合
        if ($user) {
            $_SESSION['id'] = $user['admin_id']; // セッションにユーザーIDを保存
            $_SESSION['mail'] = $user['admin_mail'];
            $_SESSION['pass'] = $user['admin_password'];
        } else {
            // ログイン失敗時のエラーメッセージ表示
            echo '<div class="container"><div class="message success">EmailかPasswordが違います</div>';
            echo '<form action="kanrisya_login.php" method="post"><input class="nav-button" type="submit" value="戻る"></form></div>';
            exit;
        }
    }
    $pdo = null;
?>

<?php
    //メールアドレスとパスワードが入力されているか確認
    $error = [];
    if(empty($_SESSION['id'])){
        echo '<div class="container">';
        if(empty($_POST['mail'])){
            $error[] = '<div class="message success">メールアドレスを入力してください</div>';
        }
        if(empty($_POST['pass'])){
            $error[] = '<div class="message success">パスワードを入力してください</div>';
        }
        foreach($error as $e){
            echo $e.'<br>';
        }
        echo '<form action="kanrisya_login.php" method="post"><input class="nav-button" type="submit" value="戻る"></form></div>';
        exit;
    }
?>