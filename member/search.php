<?php require('../header/header.php'); 

  // Daihatsuの画像を表示
if (isset($_POST['daihatu_x'])) {
  echo '<img src="../img/Daihatsu.png" alt="Daihatsu">';
  // Nissanの画像を表示
}else if (isset($_POST['nissan_x'])) {
  echo '<img src="../img/Nissan.png" alt="Nissan" width="150px">';
  // Mazdaの画像を表示
}else if (isset($_POST['matuda_x'])) {
  echo '<img src="../img/Mazda.png" alt="Mazda">';
  // Toyotaの画像を表示
}else if (isset($_POST['toyota_x'])) {
  echo '<img src="../img/Toyota.png" alt="Toyota">';
  // Hondaの画像を表示
}else if (isset($_POST['honda_x'])) {
  echo '<img src="../img/Honda.png" alt="Honda">';
  // Porscheの画像を表示
}else if (isset($_POST['porsche_x'])) {
  echo '<img src="../img/Porsche.png" alt="Porsche">';
  // Lexusの画像を表示
}else if (isset($_POST['lexus_x'])) {
  echo '<img src="../img/Lexus.png" alt="Lexus">';
  // Lamborghiniの画像を表示
}else if (isset($_POST['lambo_x'])) {
  echo '<img src="../img/Lamborghini.png" alt="Lamborghini">';
  // BMWの画像を表示
}else if (isset($_POST['bmw_x'])) {
  echo '<img src="../img/BMW.png" alt="BMW">';
  // Ferrariの画像を表示+
}else if (isset($_POST['ferrari_x'])) {
  echo '<img src="../img/Ferrari.png" alt="Ferrari">';
}

?>

<div class="search">
  <!-- ブランド -->
  <div class="brands-title">ブランド</div>
  <div class="checkbox-container">
    <label><input type="checkbox" name="blands[]" value="Toyota"></label>
    <label><input type="checkbox" name="blands[]" value="Mazda"></label>
    <label><input type="checkbox" name="blands[]" value="Lexus"></label>
    <label><input type="checkbox" name="blands[]" value="Honda"></label>
    <label><input type="checkbox" name="blands[]" value="Porsche"></label>
    <label><input type="checkbox" name="blands[]" value="Ferrari"></label>
    <label><input type="checkbox" name="blands[]" value="Lamborghini"></label>
    <label><input type="checkbox" name="blands[]" value="BMW"></label>
    <label><input type="checkbox" name="blands[]" value="Daihatsu"></label>
    <label><input type="checkbox" name="blands[]" value="Nissan"></label>  
  </form>
  </div>

  <!-- 価格 -->
  <div class="price-title">価格</div>
  <div class="price-range">
  <form method="price" action="">
    <input type="radio" name="price" value="30">～30万円</option>
    <input type="radio" name="price" value="50">～50万円</option>
    <input type="radio" name="price" value="100">～100万円</option>
    <input type="radio" name="price" value="200">～200万円</option>
    <input type="radio" name="price" value="200over">200万円～</option>
  </form>
  </div>

  <!-- ボディタイプ -->
  <div class="body-type-title">ボディタイプ</div>
  <div class="body-type">
  <form method="body-type" action="">
    <label><input type="checkbox" name="body-type[]" value="Sedan"></label>
    <label><input type="checkbox" name="body-type[]" value="SUV"></label>
    <label><input type="checkbox" name="body-type[]" value="Wagon"></label>
    <label><input type="checkbox" name="body-type[]" value="Conpact"></label>
    <label><input type="checkbox" name="body-type[]" value="Light"></label>
  </form>
  </div>

  <!-- カラー -->
  <div class="color-title">カラー</div>
  <div class="color-options">
  <form method="color" action="">
    <label><input type="checkbox" name="color[]" value="Black"></label>
    <label><input type="checkbox" name="color[]" value="White"></label>
  </form>
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
