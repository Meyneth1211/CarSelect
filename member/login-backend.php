<?php
    session_start();
    require_once 'DbManager.php';
    $pdo = getDb();

    //メールアドレスとパスワードが入力されているか確認
    if(!empty($_POST['mail'])&&!empty($_POST['password'])){
        $sql=$pdo->prepare('SELECT * from user where mail=? and password=?');
        $sql->execute([$_POST['mail'],$_POST['password']]);
        foreach($sql as $row){
            $_SESSION['mail'] = $row['mail'];
            $_SESSION['name'] = $row['user_name'];
        }
        if(!empty($_SESSION['name'])){
            
        }else{
            echo 'EmailかPasswordが違います<br>';
            echo '<a href="login.php">戻る</a>';
            exit;
        }
    }
    
    

    $pdo = null;
?>