<?php
    if ($_SERVER['REQUEST_METHOD']==='GET') {
        require('../header/header.php');
        echo <<<FORM
            <div class="login">
                <div class="login-card">
                    <h2>ログイン</h2>
                    <form class="login-form" action="top.php" method="post">
                        <input class="mail" name="mail" type="text" placeholder="Email">
                        <input class="pass" name="pass" type="password" placeholder="Password">
                        <div class="top"></div>
                        <input class="button-1" type="submit" value="ログイン">
                    </form>
                    <form class="login-form" action="signup.php" method="post">
                        <input class="button-2" type="submit" value="アカウント新規作成">
                    </form>
                </div>
            </div>
        FORM;
    }elseif ($_SERVER['REQUEST_METHOD']==='POST') {
        if (!empty($_POST['mail']) && !empty($_POST['pass'])) {
            session_start();
            require_once '../DBconnect.php';
            $pdo = getDb();
            $sql='SELECT user_id, user_name FROM user WHERE user_mail = ? AND user_password = ?';
            $stmt=$pdo->prepare($sql);
            $stmt->execute([$_POST['mail'], $_POST['pass']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!empty($result)){
                $_SESSION['id'] = $result['user_id'];
                $_SESSION['name'] = $result['user_name'];
                var_dump($result);
                //header('Location: ./top.php');
            }else {
                echo '<div class="error-back"><div class="error-card2">';
                echo '<div class="error-message">メールアドレスかパスワードが間違っています</div>';
                echo '<form class="login-form" action="login.php" method="get"><input class="button-1" type="submit" value="戻る"></form></div></div>';
            }
            $pdo=null;
        }
    }
?>