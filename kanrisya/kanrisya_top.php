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
            echo '<a class="return-button" href="login.php">戻る</a></div>';
            exit;
        }
    }
    $pdo = null;
?>


<div class="top_button">
    <input class="top_button1" type="button" onclick="location.href='user_list'" value="ユーザー削除">
    <input class="top_button2" type="button" onclick="location.href='kanrisya_signup'" value="管理者登録">
    <input class="top_button3" type="button" onclick="location.href='car_list'" value="在庫管理">
    <input class="top_button4" type="button" onclick="location.href='#'" value="商品追加">
</div>

</body>
</html>