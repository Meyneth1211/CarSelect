<?php require('../header/header.php'); ?>

<div class="search">
  <!-- ブランド -->
  <div class="brands-title">ブランド</div>
  <div class="brands">
    <img src="../img/Toyota.png" alt="Toyota" width="75" height="50">
    <img src="../img/Mazda.png" alt="Mazda" width="75" height="50">
    <img src="../img/Lexus.png" alt="Lexus" width="75" height="50">
    <img src="../img/Honda.png" alt="Honda" width="75" height="50">
    <img src="../img/Porsche.png" alt="Porsche" width="75" height="50">
    <img src="../img/Ferrari.png" alt="Ferrari" width="75" height="50">
    <img src="../img/Lamborghini.png" alt="Lamborghini" width="75" height="50">
    <img src="../img/BMW.png" alt="BMW" width="75" height="50">
    <img src="../img/Subaru.png" alt="Subaru" width="75" height="50">
    <img src="../img/Daihatsu.png" alt="Daihatsu" width="75" height="50">
  </div>

  <!-- 価格 -->
  <div class="price-title">価格</div>
  <div class="price-range">
    <input type="radio" name="price" value="30">～30万円</option>
    <input type="radio" name="price" value="50">～50万円</option>
    <input type="radio" name="price" value="100">～100万円</option>
    <input type="radio" name="price" value="200">～200万円</option>
    <input type="radio" name="price" value="200over">200万円～</option>
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
