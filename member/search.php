<?php require('../header/header.php'); ?>

<div class="search">
  <!-- ブランド -->
  <div class="brands-title">ブランド</div>
  <div class="brands">
    <img src="Toyota.png" alt="Toyota">
    <img src="Mazda.png" alt="Mazda">
    <img src="Lexus.png" alt="Lexus">
    <img src="Honda.png" alt="Honda">
    <img src="Porsche.png" alt="Porsche">
    <img src="Ferrari.png" alt="Ferrari">
    <img src="Lamborghini.png" alt="Lamborghini">
    <img src="BMW.png" alt="BMW">
    <img src="Subaru.png" alt="Subaru">
    <img src="Daihatsu.png" alt="Daihatsu">
  </div>

  <!-- 価格 -->
  <div class="price-title">価格</div>
  <div class="price-range">
  <select name="price">
    <option value="30">〜30万円</option>
    <option value="50">〜50万円</option>
    <option value="100">〜100万円</option>
    <option value="200">〜200万円</option>
    <option value="200over">200万円以上～</option>
  </select>
  </div>

  <!-- ボディタイプ -->
  <div class="body-type-title">ボディタイプ</div>
  <div class="body-type">
    <img src="sedan-icon.png" alt="Sedan">
    <img src="suv-icon.png" alt="SUV">
    <img src="wagon-icon.png" alt="Wagon">
    <img src="coupe-icon.png" alt="Coupe">
  </div>

  <!-- カラー -->
  <div class="color-title">カラー</div>
  <div class="color-options">
    <button style="background-color: black; color: white;">ブラック</button>
    <button style="background-color: white; color: black;">ホワイト</button>
  </div>

  <!-- 車のリスト -->
  <div class="car-list">
    <div class="car-item">
      <img src="lexus-ux300e.jpg" alt="UX300e">
      <div class="car-info">
        <h3>UX300e</h3>
        <p>7,000,000円</p>
      </div>
      <div class="favorite-icon">♡</div>
    </div>
    <div class="car-item">
      <img src="lexus-ux300e.jpg" alt="UX300e">
      <div class="car-info">
        <h3>UX300e</h3>
        <p>7,000,000円</p>
      </div>
      <div class="favorite-icon">♡</div>
    </div>
  </div>
</div>

</body>
</html>
