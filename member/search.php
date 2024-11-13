<?php require('../header/header.php'); ?>

<div class="search">
  <!-- ブランド -->
  <div class="brands-title">ブランド</div>
  <div class="brands" select name="blands" id="blands">
  <select name="blands">
    <option value="Toyota" class="Toyota"></option>
    <option value="Mazda" class="Mazda"></option>
    <option value="Lexus" class="Lexus"></option>
    <option value="Honda" class="Honda"></option>
    <option value="Porsche" class="Porsche"></option>
    <option value="Ferrari" class="Ferrari"></option>
    <option value="Lamborghini" class="Lamborghini"></option>
    <option value="BMW" class="BMW"></option>
    <option value="Daihatsu" class="Daihatsu"></option>
    <option value="Subaru" class="Subaru"></option>
  </select>
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
  <select name="body-type">
    <option value="Sedan" class="Sedan"></option>
    <option value="SUV" class="SUV"></option>
    <option value="Wagon" class="Wagon"></option>
    <option value="Compact" class="Compact"></option>
    <option value="Light" class="Light"></option>
  </select>
  </div>

  <!-- カラー -->
  <div class="color-title">カラー</div>
  <div class="color-options">
  <select name="color">
    <option value="Black" class="Black"></option>
    <option value="White" class="White"></option>
  </select>
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
