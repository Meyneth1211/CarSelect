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
            echo '<div class="error-message">EmailかPasswordが違います</div><br>';
            echo '<a class="return-button" href="login.php">戻る</a>';
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
        echo '<a class="return-button" href="login.php">戻る</a>';
        exit;
    }
?>
<div id="slider"></div>
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
    <img src="../img/Porsche.png" alt="" width="60%">
    <img src="../img/Lexus.png" alt="">
    <img src="../img/Lamborghini.png" alt="">
    <img src="../img/BMW.png" alt="">
    <img src="../img/Ferrari.png" alt="">
</div>
</body>
</html>