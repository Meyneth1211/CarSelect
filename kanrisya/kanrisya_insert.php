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
    <form action="kanrisya_insert_back.php" method="post">
    <p>商品名</p>
        <input type="text" name="car_name"><br><br>
    
    <p>メーカー</p>
    <div class="radio-images">
        <label>
            <input type="radio" name="brands" value="トヨタ">
             <img src="../img/Toyota.png" alt="Toyota">
        </label>
        <label>
            <input type="radio" name="brands" value="マツダ">
            <img src="../img/Mazda.png" alt="Mazda">
        </label>
        <label>
            <input type="radio" name="brands" value="レクサス">
            <img src="../img/Lexus.png" alt="Lexus">
        </label>
        <label>
            <input type="radio" name="brands" value="ホンダ">
            <img src="../img/Honda.png" alt="Honda">
        </label>
        <label>
            <input type="radio" name="brands" value="ポルシェ">
            <img src="../img/Porsche.png" alt="Porsche">
        </label>
        <label>
            <input type="radio" name="brands" value="フェラーリ">
            <img src="../img/Ferrari.png" alt="Ferrari">
        </label>
        <label>
            <input type="radio" name="brands" value="ランボルギーニ">
            <img src="../img/Lamborghini.png" alt="Lamborghini">
        </label>
        <label>
            <input type="radio" name="brands" value="BMW">
            <img src="../img/BMW.png" alt="BMW">
        </label>
        <label>
            <input type="radio" name="brands" value="ダイハツ">
            <img src="../img/Daihatsu.png" alt="Daihatsu">
        </label>
        <label>
            <input type="radio" name="brands" value="日産">
            <img src="../img/Nissan.png" alt="Nissan">
        </label>
    </div>

    <p>ボディタイプ</p>
    <div class="body-type">
        <label>
            <input type="radio" name="body-type" value="セダン">
            <img src="../img/セダン黒.png" alt="セダン">
        </label>
        <label>
            <input type="radio" name="body-type" value="SUV">
            <img src="../img/SUV黒.png" alt="SUV">
        </label>
        <label>
            <input type="radio" name="body-type" value="トラック">
            <img src="../img/トラック黒.png" alt="トラック">
        </label>
        <label>
            <input type="radio" name="body-type" value="コンパクト">
            <img src="../img/ワンボックスカー黒.png" alt="コンパクト">
        </label>
        <label>
            <input type="radio" name="body-type" value="スポーツカー">
            <img src="../img/スポーツカー黒.png" alt="スポーツカー">
        </label>
    </div>
    
    <p>値段</p>
        <input type="number" name="insert-price"><br><br>
    
    <p>詳細</p>
        <textarea name="insert-detail" id=""></textarea><br><br>

    <p></p>
      <div class="color-button">
        <input type="radio" id="black" name="options" value="black">
        <label for="option1" class="black">BLACK</label>
        <input type="radio" id="white" name="options" value="white">
        <label for="option2" class="white">WHITE</label>
      </div>
    </form>
</body>
</html>