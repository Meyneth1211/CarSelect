<?php
require('kanrisya_header.php'); 
require_once '../DBconnect.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <p>商品名</p>
        <input type="text" name="car_name"><br><br>
    
    <p>メーカー</p>
    <div class="radio-images">
        <label>
            <input type="radio" name="brands" value="Toyota">
             <img src="../img/Toyota.png" alt="Toyota">
        </label>
        <label>
            <input type="radio" name="brands" value="Mazda">
            <img src="../img/Mazda.png" alt="Mazda">
        </label>
        <label>
            <input type="radio" name="brands" value="Lexus">
            <img src="../img/Lexus.png" alt="Lexus">
        </label>
        <label>
            <input type="radio" name="brands" value="Honda">
            <img src="../img/Honda.png" alt="Honda">
        </label>
        <label>
            <input type="radio" name="brands" value="Porsche">
            <img src="../img/Porsche.png" alt="Porsche">
        </label>
        <label>
            <input type="radio" name="brands" value="Ferrari">
            <img src="../img/Ferrari.png" alt="Ferrari">
        </label>
        <label>
            <input type="radio" name="brands" value="Lamborghini">
            <img src="../img/Lamborghini.png" alt="Lamborghini">
        </label>
        <label>
            <input type="radio" name="brands" value="BMW">
            <img src="../img/BMW.png" alt="BMW">
        </label>
        <label>
            <input type="radio" name="brands" value="Daihatsu">
            <img src="../img/Daihatsu.png" alt="Daihatsu">
        </label>
        <label>
            <input type="radio" name="brands" value="Nissan">
            <img src="../img/Nissan.png" alt="Nissan">
        </label>
    </div>
    
    <p>値段</p>
    <input type="text" name="insert-price"><br><br>
    
    <p>詳細</p>
    <textarea name="insert-detail" id=""></textarea><br><br>

    
    </form>
</body>
</html>