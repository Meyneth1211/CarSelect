<?php require('../header/header.php'); ?>

<div class="search">
  <!-- ブランド -->
  <div class="title">
    <h2>ブランド</h2>
  </div>
  <div class="checkbox-container">
    <label>
      <?php print_r($_POST['brands']); ?>
      <!-- <input type="checkbox" name="brands[]" value="Toyota" <? (isset($_POST['brands'])) ? 'checkd' : null ?>> -->
      <img src="../img/Toyota.png" alt="Toyota" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="Mazda">
      <img src="../img/Mazda.png" alt="Mazda" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="Lexus">
      <img src="../img/Lexus.png" alt="Lexus" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="Honda">
      <img src="../img/Honda.png" alt="Honda" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="Porsche">
      <img src="../img/Porsche.png" alt="Porsche" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="Ferrari">
      <img src="../img/Ferrari.png" alt="Ferrari" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="Lamborghini">
      <img src="../img/Lamborghini.png" alt="Lamborghini" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="BMW">
      <img src="../img/BMW.png" alt="BMW" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="Daihatsu">
      <img src="../img/Daihatsu.png" alt="Daihatsu" width="100px">
    </label>
    <label>
      <input type="checkbox" name="brands[]" value="Nissan">
      <img src="../img/Nissan.png" alt="Nissan" width="100px">
    </label>
  </div>

  <!-- 価格 -->
  <div class="title">
    <h2>価格</h2>
  </div>
  <div class="price-range">
    <form method="post" action="">
      <input type="radio" name="price" value="30" id="price-30" hidden>
      <button type="button" onclick="selectPrice('price-30', '～30万円', this)">～30万円</button>

      <input type="radio" name="price" value="50" id="price-50" hidden>
      <button type="button" onclick="selectPrice('price-50', '～50万円', this)">～50万円</button>

      <input type="radio" name="price" value="100" id="price-100" hidden>
      <button type="button" onclick="selectPrice('price-100', '～100万円', this)">～100万円</button>

      <input type="radio" name="price" value="200" id="price-200" hidden>
      <button type="button" onclick="selectPrice('price-200', '～200万円', this)">～200万円</button>

      <input type="radio" name="price" value="200over" id="price-200over" hidden>
      <button type="button" onclick="selectPrice('price-200over', '200万円～', this)">200万円～</button>
    </form>
  </div>
  <!-- もし価格が選択されていなければこれを表示 -->
  <div class="select-color" id="selected-price">
    <p>選択された価格: なし</p>
  </div>


  <!-- ボディタイプ -->
  <div class="title">
    <h2>ボディタイプ</h2>
  </div>
  <div class="body-type">
    <form method="body-type" action="">
      <label>
        <input type="checkbox" name="body-type[]" value="Sedan">
        <img src="../img/セダン.png" alt="セダン" width="30px">
      </label>
      <label>
        <input type="checkbox" name="body-type[]" value="SUV">
        <img src="../img/SUV.png" alt="SUV" width="30px">
      </label>
      <label>
        <input type="checkbox" name="body-type[]" value="Wagon">
        <img src="../img/トラック.png" alt="ワゴン" width="25px">
      </label>
      <label>
        <input type="checkbox" name="body-type[]" value="Conpact">
        <img src="../img/ワンボックスカー.png" alt="コンパクト" width="23x">
      </label>
      <label>
        <input type="checkbox" name="body-type[]" value="Light">
        <img src="../img/スポーツカー.png" alt="スポーツカー" width="40px">
      </label>
    </form>
  </div>

  <!-- カラー -->
  <div class="title">
    <h2>カラー</h2>
  </div>
  <div class="color-options">
    <form class="car-color-button" method="color" action="">
      <div class="color-brack">
        <input type="checkbox" id="black" name="color[]" value="Black" />
        <label for="black">ブラック</label>
      </div>
      <div class="color-white">
        <input type="checkbox" id="white" name="color[]" value="White" />
        <label for="white">ホワイト</label>
      </div>
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
<script src="../js/search.js"></script>
</body>

</html>