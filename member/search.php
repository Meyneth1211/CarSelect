<?php require('../header/header.php'); ?>

<div class="header">Car Select</div>

<div class="container">
  <!-- ブランド -->
  <div class="section-title">ブランド</div>
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
  <div class="section-title">価格</div>
  <div class="price-range">
    <button>〜30万円</button>
    <button>〜50万円</button>
    <button>〜100万円</button>
    <button>〜200万円</button>
    <button>200万円以上〜</button>
  </div>

  <!-- ボディタイプ -->
  <div class="section-title">ボディタイプ</div>
  <div class="body-type">
    <img src="sedan-icon.png" alt="Sedan">
    <img src="suv-icon.png" alt="SUV">
    <img src="wagon-icon.png" alt="Wagon">
    <img src="coupe-icon.png" alt="Coupe">
  </div>

  <!-- カラー -->
  <div class="section-title">カラー</div>
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
