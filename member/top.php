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
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['mail'] = $row['user_mail'];
            $_SESSION['name'] = $row['user_name'];
        }
        if(!empty($_SESSION['name'])){
            
        }else{
            echo '<div class="error-message">EmailかPasswordが違います</div>';
            echo '<a class="return-button" href="logout.php">戻る</a>';
            exit;
        }
    }
    $pdo = null;
?>
<?php
    //メールアドレスとパスワードが入力されているか確認
    $error = [];
    if(empty($_SESSION['name'])){
        echo '<div class="error-back"><div class="error-card">';
        if(empty($_POST['mail'])){
            $error[] = '<div class="error-message">メールアドレスを入力してください</div>';
        }
        if(empty($_POST['pass'])){
            $error[] = '<div class="error-message">パスワードを入力してください</div>';
        }
        foreach($error as $e){
            echo $e.'<br>';
        }
        echo '<form class="login-form" action="login.php" method="post"><input class="button-1" type="submit" value="戻る"></form></div></div>';
        exit;
    }
?>
<div id="slider"></div>
<h1>テスト</h1>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.4/vegas.min.js"></script>
<script src="../js/slide.js"></script>
<div class="car-logo">
    <img src="../img/Toyota.png" alt="">
    <img src="../img/Daihatsu.png" alt="">
    <img src="../img/Mazda.png" alt="">
    <img src="../img/Subaru.png" alt="">
    <img src="../img/Honda.png" alt="">
</div>
<div class="car-logo2">
    <img src="../img/Porsche.png" alt="" width="">
    <img src="../img/Lexus.png" alt="">
    <img src="../img/Lamborghini.png" alt="">
    <img src="../img/BMW.png" alt="">
    <img src="../img/Ferrari.png" alt="">
</div>
</body>
</html>
