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
            <li><a class="nenu-link" href="#">TOP</a></li>
            <li><a class="nenu-link" href="#">SEARCH</a></li>
            <li><a class="nenu-link" href="#">FAVORITE</a></li>
            <li><a class="nenu-link" href="#">LOGOUT</a></li>
            <li><a class="nenu-link" href="#">LOGIN</a></li>
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