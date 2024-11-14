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
</head>
<body>
    <!-- ハンバーガーメニュー -->
    <div class="menu-toggle" id="menuToggle">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <!-- メニュー classを追加-->
    <nav id="menu" class="hidden">
        <ul>
            <li><a class="nenu-link" href="../member/top.php">TOP</a></li>
            <li><a class="nenu-link" href="#">SEARCH</a></li>
            <li><a class="nenu-link" href="#">FAVORITE</a></li>
            <li><a class="nenu-link" href="../member/account.php">ACCOUNT</a></li>
            <li><a class="nenu-link" href="../member/logout.php">LOGOUT</a></li>
            <li><a class="nenu-link" href="../member/logout.php">LOGIN</a></li>
        </ul>
    </nav>

    <div class="back">
        <h2>Car Select</h2>
    </div>

    <script>
        // ハンバーガーメニューの動作
        const menuToggle = document.getElementById('menuToggle');
        const menu = document.getElementById('menu');
        
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden'); // メニューの表示・非表示切り替え
        });
    </script>