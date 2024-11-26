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
        <h1 class="syohinn-insert">商品追加</h1>
    <table class="insert-table">
    <tr>
        <th><h3>商品名</h3></th>
        <td><input type="text" name="car_name" class="car_name" placeholder="商品名を入力してください" required><br><br></td>
    </tr>

    <tr>
    <th><h3>メーカー</h3></th>
    <td>
    <div class="radio-images">
        <label>
            <input type="radio" name="brands" value="トヨタ" required>
             <img src="../img/Toyota.png" alt="Toyota">
        </label>
        <label>
            <input type="radio" name="brands" value="マツダ" required>
            <img src="../img/Mazda.png" alt="Mazda">
        </label>
        <label>
            <input type="radio" name="brands" value="レクサス" required>
            <img src="../img/Lexus.png" alt="Lexus">
        </label>
        <label>
            <input type="radio" name="brands" value="ホンダ" required>
            <img src="../img/Honda.png" alt="Honda">
        </label>
        <label>
            <input type="radio" name="brands" value="ポルシェ" required>
            <img src="../img/Porsche.png" alt="Porsche">
        </label>
        <label>
            <input type="radio" name="brands" value="フェラーリ" required>
            <img src="../img/Ferrari.png" alt="Ferrari">
        </label>
        <label>
            <input type="radio" name="brands" value="ランボルギーニ" required>
            <img src="../img/Lamborghini.png" alt="Lamborghini">
        </label>
        <label>
            <input type="radio" name="brands" value="BMW" required>
            <img src="../img/BMW.png" alt="BMW">
        </label>
        <label>
            <input type="radio" name="brands" value="ダイハツ" required>
            <img src="../img/Daihatsu.png" alt="Daihatsu">
        </label>
        <label>
            <input type="radio" name="brands" value="日産" required>
            <img src="../img/Nissan.png" alt="Nissan">
        </label>
        </td>
    </div>
    </tr>

    <tr>
    <th><h3>ボディタイプ</h3></th>
    <td>
    <div class="body-type">
        <label>
            <input type="radio" name="body-type" value="セダン" required>
            <img src="../img/セダン黒.png" alt="セダン">
        </label>
        <label>
            <input type="radio" name="body-type" value="SUV" required>
            <img src="../img/SUV黒.png" alt="SUV">
        </label>
        <label>
            <input type="radio" name="body-type" value="スポーツカー" required>
            <img src="../img/スポーツカー黒.png" alt="スポーツカー">
        </label>
    </td>
    </div>
    </tr>
    
    <tr>
    <th><h3>値段</h3></th>
        <td><input type="number" name="insert-price" class="insert-price" placeholder="値段を設定してください" required><br><br></td>
    </tr>

    <tr>
    <th><h3>在庫数</h3></th>
        <td><input type="number" name="insert-stock" class="insert-stock" min="0" placeholder="在庫数を設定してください" required></td>
    </tr>

    <tr>
    <th><h3>詳細</h3></th>
        <td><textarea name="insert-detail" id="" placeholder="商品の説明を入力してください" required></textarea><br><br></td>
    </tr>

    <tr>
    <th><h3>カラー</h3></th>
      <td><div class="color-button">
        <input type="radio" id="black" name="color" value="ブラック" required>
        <label for="black" class="black">BLACK</label>
        
        <input type="radio" id="white" name="color" value="ホワイト" required>
        <label for="white" class="white">WHITE</label>
      </div></td>
    </tr>

    <tr>  
    <th><h3>メイン画像</h3></th>
        <td>
        <label for="main_image" class="file-upload">
            <img src="../img/image.png" alt="アップローボタン" class="upload-button-image">
        </label>
        <input type="file" id="main-image" name="main_image" required style="display: none;"><br></td>
    </tr>

    <tr>
    <th><h3>その他の画像</h3></th>
        <td>
        <label for="main_image" class="file-upload">
            <img src="../img/image.png" alt="複数アップローボタン" class="upload-button-image">
        </label>
            <input type="file" id="other_images" name="other_images[]" multiple required style="display: none;"><br><br></td>
    </tr>
    </table>
    <div class="kanrisya-insert-button">
        <input class="save-button" type="submit" name="send" value="登録">
        <button class="back-button" onclick="location.href='https://aso2301389.hippy.jp/carselect/kanrisya/kanrisya_top.php';">トップページへ戻る</button>
    </div>
    </form>
</body>
</html>