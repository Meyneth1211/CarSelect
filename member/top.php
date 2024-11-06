<?php
    session_start();
    require('../header/header.php');
    require_once '../DBconnect.php';
    $pdo = getDb();

    //メールアドレスとパスワードが入力されているか確認
    if(!empty($_POST['mail'])&&!empty($_POST['pass'])){
        $sql=$pdo->prepare('SELECT * from user where user_mail=? and user_password=?');
        $sql->execute([$_POST['mail'],$_POST['pass']]);
        foreach($sql as $row){
            $_SESSION['mail'] = $row['user_mail'];
            $_SESSION['name'] = $row['user_name'];
        }
        if(!empty($_SESSION['name'])){
            
        }else{
            echo '<div class="Error-Message">EmailかPasswordが違います</div><br>';
            echo '<div class="Error-Message"><a href="login.php">戻る</a></div>';
            exit;
        }
    }
?>
<?php
    //メールアドレスとパスワードが入力されているか確認
    $error = [];
    if(empty($_SESSION['name'])){
        echo '    <div class="toukou1">';
        if(empty($_POST['mail'])){
            $error[] = 'メールアドレスを入力してください';
        }
        if(empty($_POST['pass'])){
            $error[] = 'パスワードを入力してください';
        }
        foreach($error as $e){
            echo $e.'<br>';
        }
        echo '<a href="login.php">戻る</a>';
        exit;
    }
?>


</body>
</html>