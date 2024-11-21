<?php 
    session_start();
    require('kanrisya_header.php'); 
    require_once '../DBconnect.php';
    $pdo = getDb();

    //メールアドレスとパスワードが入力されているか確認
    if(!empty($_POST['mail'])&&!empty($_POST['pass'])){
        $sql=$pdo->prepare('SELECT * from admin where admin_mail=? and admin_password=?');
        $sql->execute([$_POST['mail'],$_POST['pass']]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // ユーザーが存在する場合
        if ($user) {
            $_SESSION['user_id'] = $user['admin_id']; // セッションにユーザーIDを保存
            $_SESSION['mail'] = $user['admin_mail'];
            $_SESSION['name'] = $user['admin_name'];
        } else {
            // ログイン失敗時のエラーメッセージ表示
            echo '<div class="container"><div class="message success">EmailかPasswordが違います</div>';
            echo '<a class="return-button" href="kanrisya_login.php">戻る</a></div>';
            exit;
        }
    }
    $pdo = null;
?>

<?php
    //メールアドレスとパスワードが入力されているか確認
    $error = [];
    if(empty($_SESSION['name'])){
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
        echo '<form action="login.php" method="post"><input class="nav-button" type="submit" value="戻る"></form></div>';
        exit;
    }
?>


<div class="top_button">
    <input class="top_button1" type="button" onclick="location.href='user_list'" value="ユーザー削除">
    <input class="top_button2" type="button" onclick="location.href='kanrisya_signup'" value="管理者登録">
    <input class="top_button3" type="button" onclick="location.href='car_list'" value="在庫管理">
    <input class="top_button4" type="button" onclick="location.href='#'" value="商品追加">
</div>

</body>
</html>