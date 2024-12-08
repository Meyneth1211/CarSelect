<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Select</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/card.css">
    <link rel="stylesheet" href="../css/top.css">
    <link rel="stylesheet" href="../css/account.css">
    <link rel="stylesheet" href="../css/guest.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="../css/slide.css">
    <link rel="stylesheet" href="../css/kounyuu.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/Purchase_confirmed.css">
    <link rel="stylesheet" href="../css/account_update.css">
    <link rel="stylesheet" href="../css/edit_success.css">
    <link rel="stylesheet" href="../css/car_datail.css">
    <link href='https://fonts.googleapis.com/css?family=Brawler' rel='stylesheet'>
</head>

<body>
    <!-- ハンバーガーメニュー -->
    <section>
        <div class="menuToggle" id="menuToggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </section>

    <!-- メニュー classを追加-->
    <nav id="menu" class="hidden">
        <ul>
            <li><a class="nenu-link" href="../member/top.php">TOP</a></li>
            <li><a class="nenu-link" href="../member/search.php">SEARCH</a></li>
            <li><a class="nenu-link" href="../member/favorites.php">FAVORITE</a></li>
            <li><a class="nenu-link" href="../member/account.php">ACCOUNT</a></li>
            <li><a class="nenu-link" href="../member/logout.php">LOGOUT</a></li>
            <li><a class="nenu-link" href="../member/logout.php">LOGIN</a></li>
            <li><a class="nenu-link" href="../member/signup.php">SIGNUP</a></li>
        </ul>
    </nav>

    <div class="header_back">


        <div class="back">
            <div class="logo_logo">
                <a class="logo_link" href="top.php">Car Select</a>
            </div>
        </div>


        <div class="account_logo_button">
            <div class="account_icon">
                <a href="account.php">
                    <img class="account_icon_img" src="../img/画像__5_negate.png" alt="Account Icon">
                </a>
                <div class="dropdown">
                    <?php if (!empty($_SESSION['name'])): ?>
                        <p><?php echo $_SESSION['name']; ?>様<br><a class="url_login" href="logout.php">ログアウト</a></p>
                    <?php else: ?>
                        <p>ゲスト<br><a class="url_login" href="login.php">ログインする</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>





    </div>



    <script>
        $(function() {
            $('.btn-trigger').on('click', function() {
                $(this).toggleClass('active');
                return false;
            });
        });
    </script>

    <script>
        // ハンバーガーメニューの動作
        const menuToggle = document.getElementById('menuToggle');
        const menu = document.getElementById('menu');

        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden'); // メニューの表示・非表示切り替え
        });
    </script>