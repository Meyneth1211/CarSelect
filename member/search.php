<?php require('../header/header.php'); ?>

<!-- formタグはここより開始 action欄を空にすることでこのページ自身に送信 -->
<form action="" method="get">

<!-- 検索のリクエストが行われたことを判定する変数 -->
<input type="hidden" name="s">
<div class="search">
  <!-- ブランド -->
  <div class="title"><h2>ブランド</h2></div>
  <div class="checkbox-container">
  <label>
    <input type="checkbox" name="brands[]" value="'トヨタ'" >
    <img src="../img/Toyota.png" alt="Toyota" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'マツダ'">
    <img src="../img/Mazda.png" alt="Mazda" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'レクサス'">
    <img src="../img/Lexus.png" alt="Lexus" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'ホンダ'">
    <img src="../img/Honda.png" alt="Honda" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'ポルシェ'">
    <img src="../img/Porsche.png" alt="Porsche" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'フェラーリ'">
    <img src="../img/Ferrari.png" alt="Ferrari" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'ランボルギーニ'">
    <img src="../img/Lamborghini.png" alt="Lamborghini" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'BMW'">
    <img src="../img/BMW.png" alt="BMW" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'ダイハツ'">
    <img src="../img/Daihatsu.png" alt="Daihatsu" width="100px">
  </label>
  <label>
    <input type="checkbox" name="brands[]" value="'日産'">
    <img src="../img/Nissan.png" alt="Nissan" width="100px">
  </label>
</div>

  <!-- 価格 -->
  <div class="title"><h2>価格</h2></div>
<div class="price-range">
    <input type="radio" name="price" value="4000000" id="price-30" hidden>
    <button type="button" onclick="selectPrice('price-30', '～400万円', this)">～400万円</button>

    <input type="radio" name="price" value="6000000" id="price-50" hidden>
    <button type="button" onclick="selectPrice('price-50', '～600万円', this)">～600万円</button>

    <input type="radio" name="price" value="8000000" id="price-100" hidden>
    <button type="button" onclick="selectPrice('price-100', '～800万円', this)">～800万円</button>

    <input type="radio" name="price" value="10000000" id="price-200" hidden>
    <button type="button" onclick="selectPrice('price-200', '～1000万円', this)">～1000万円</button>

    <input type="radio" name="price" value="over" id="price-200over" hidden>
    <button type="button" onclick="selectPrice('price-200over', '1000万円～', this)">1000万円～</button>
</div>
<!-- もし価格が選択されていなければこれを表示 -->
<div class="select-color" id="selected-price"><p>選択された価格: なし</p></div>


  <!-- ボディタイプ -->
  <div class="title"><h2>ボディタイプ</h2></div>
  <div class="body-type">
    <label>
      <input type="checkbox" name="bodytype[]" value="'セダン'">
      <img src="../img/セダン.png" alt="セダン" width="30px">
    </label>
    <label>
      <input type="checkbox" name="bodytype[]" value="'SUV'">
      <img src="../img/SUV.png" alt="SUV" width="30px">
    </label>
    <label>
      <input type="checkbox" name="bodytype[]" value="'スポーツカー'">
      <img src="../img/スポーツカー.png" alt="スポーツカー" width="40px">
    </label>
  </div>

  <!-- カラー -->
  <div class="title">
  <h2>カラー</h2>
</div>
<div class="color-options">
    <div class="color-brack">
      <input type="checkbox" id="black" name="color[]" value="'ブラック'" />
      <label for="black">ブラック</label>
    </div>
    <div class="color-white">
      <input type="checkbox" id="white" name="color[]" value="'ホワイト'" />
      <label for="white">ホワイト</label>
    </div>
</div>

<div class="submit">
      <input type="submit" value="この条件で絞り込む">
</div>
</div>

<!-- 絞り込み内容を一括送信するためここにform終了タグ -->
</form>

<!-- 車のリスト -->
<?php
  if (isset($_GET['s'])) {
    //echo '検索リクエストを確認、条件部分のSQL文を初期化';
    $suffix='';
    $first=true;
    if (isset($_GET['brands'])) {
      //echo 'brandsパラメータの存在を確認';
      $brands=$_GET['brands'];
      $suffix.='brand IN(' . implode(',',$brands) . ') ';
      $first=false;
    }

    if (isset($_GET['price'])) {
      //echo 'priceパラメータの存在を確認';
      $price=$_GET['price'];
      if (!$first) {
        $suffix.='AND ';
      }
      if ($price=='over') {
        $suffix.='price >= 10000000 ';
        $first=false;
      }else{
        $suffix.='price <= ' . $price . ' ';
        $first=false;
      }
    }

    if (isset($_GET['bodytype'])) {
      //echo 'bodytypeパラメータの存在を確認';
      if (!$first) {
        $suffix.='AND ';
      }
      $bodytype=$_GET['bodytype'];
      $suffix.='body_type IN(' . implode(',',$bodytype) . ') ';
      $first=false;
    }
    if (isset($_GET['color'])) {
      //echo 'colorパラメータの存在を確認';
      if (!$first) {
        $suffix.='AND ';
      }
      $color=$_GET['color'];
      $suffix.='color IN(' . implode(',',$color) . ')';
      $first=false;
    }
    if($first){
      $suffix.='1=1';
    }
    
    $suffix.=';';

  /*
  var_dump($brands);
  echo '<br>';
  */
  $sql = 'SELECT car_id, car_name, price FROM car WHERE ';
  $sql.= $suffix;
  //echo $sql;
  require_once '../DBconnect.php';
  $pdo=getDB();
  $stmt=$pdo->prepare($sql);
  $stmt->execute();
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  //var_dump($result);
  foreach ($result as $key => $value) {
    echo '<h1>'.$key['car_detail'].'</h1>';
  }
  }
  

?>

  <div class="car-list">
    <div class="car-item">
      <img src="lexus-ux300e.jpg">
      <div class="car-info">
        <h3>UX300e</h3>
        <p>7,000,000円</p>
      </div>
      <div class="favorite-icon">♡</div>
    </div>
    <div class="car-item">
      <img src="lexus-ux300e.jpg">
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
