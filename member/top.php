<?php
    session_start();
    require('../header/header.php');
    require_once '../DBconnect.php';
    $pdo = getDb();

    //メールアドレスとパスワードが入力されているか確認
    if(!empty($_POST['mail'])&&!empty($_POST['pass'])){
        $sql=$pdo->prepare('SELECT * from user where user_mail=? and user_password=?');
        $sql->execute([$_POST['mail'],$_POST['pass']]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // ユーザーが存在する場合
        if ($user) {
            $_SESSION['user_id'] = $user['user_id']; // セッションにユーザーIDを保存
            $_SESSION['mail'] = $user['user_mail'];
            $_SESSION['name'] = $user['user_name'];
        } else {
            // ログイン失敗時のエラーメッセージ表示
            echo '<div class="error-message">EmailかPasswordが違います</div>';
            echo '<a class="return-button" href="login.php">戻る</a>';
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
  <ul class="slider">
    <li class="slider-item slider-item01"></li>
    <li class="slider-item slider-item02"></li>
    <li class="slider-item slider-item03"></li>
  </ul>

<form action="search.php" method="post">


    <input type="image" name="image1" src="images/square1.png">
    <input type="image" name="image2" src="images/square2.png">
    <input type="image" name="image3" src="images/square3.png">
    <input type="image" name="image4" src="images/square4.png">
    <input type="image" name="image5" src="images/square5.png">
    <input type="image" name="image6" src="images/square6.png">
</form>



<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="../js/slide.js"></script>
</body>
</html>
