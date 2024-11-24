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
    <form action="kanrisya_insert_back.php" method="post" enctype="multipart/form-data">
    <h3>商品名</h3>
        <input type="text" name="car_name"><br><br>
    
    <h3>メーカー</h3>
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

    <h3>ボディタイプ</h3>
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
            <input type="radio" name="body-type" value="スポーツカー">
            <img src="../img/スポーツカー黒.png" alt="スポーツカー">
        </label>
    </div>
    
    <h3>値段</h3>
        <input type="number" name="insert-price"><br><br>
    
    <h3>在庫数</h3>
    <input type="number" name="insert-stock"  min="0" required>

    <h3>詳細</h3>
        <textarea name="insert-detail" id=""></textarea><br><br>

    <h3>カラー</h3>
      <div class="color-button">
        <input type="radio" id="black" name="color" value="ブラック">
        <label for="black" class="black">BLACK</label>
        
        <input type="radio" id="white" name="color" value="ホワイト">
        <label for="white" class="white">WHITE</label>
      </div>

    <p>車の画像</p>
        
    <h3>メイン画像</h3>
        <input type="file" name="main_image" required><br>

    <h3>その他の画像</h3>
        <input type="file" name="other_images[]" multiple><br><br>

    <input type="submit" name="send" value="登録">
    <button onclick="location.href='https://aso2301389.hippy.jp/carselect/kanrisya/kanrisya_top.php">次のページへ</button>
    </form>
</body>
</html>