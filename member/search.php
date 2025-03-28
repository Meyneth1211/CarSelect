<?php 
require('../header/header.php'); 
require 'FavListHandler.php';
?>

<!-- formタグはここより開始 action欄を空にすることでこのページ自身に送信 -->
<form action="" method="get">

  <!-- 絞り込み検索のリクエストが行われたことを判定する変数 -->
  <input type="hidden" name="s">
  <div class="search">
    <!-- ブランド -->
    <div class="bland-tail">
      <div class="search-bland-card">
        <div class="title">
          <h2>ブランド</h2>
        </div>
        <div class="checkbox-container">
          <label>
            <input type="checkbox" name="brands[]" value="'トヨタ'">
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
            <input type="checkbox" name="brands[]" value="'ベンツ'">
            <img src="../img/Benz.png" alt="Benz" width="100px">
          </label>
          <label>
            <input type="checkbox" name="brands[]" value="'日産'">
            <img src="../img/Nissan.png" alt="Nissan" width="100px">
          </label>
        </div>
      </div>
    </div>


    <!-- 価格 -->
    <div class="price-tail">
      <div class="search-price-card">
        <div class="title">
          <h2>価格</h2>
        </div>
        <div class="price-range">
          <label>
            <input type="radio" name="price" value="4000000" id="price-30" hidden>
            <button type="button" onclick="selectPrice('price-30', '～400万円', this)">～400万円</button>
          </label>
          <label>
            <input type="radio" name="price" value="6000000" id="price-50" hidden>
            <button type="button" onclick="selectPrice('price-50', '～600万円', this)">～600万円</button>
          </label>
          <label>
            <input type="radio" name="price" value="8000000" id="price-100" hidden>
            <button type="button" onclick="selectPrice('price-100', '～800万円', this)">～800万円</button>
          </label>
          <label>
            <input type="radio" name="price" value="10000000" id="price-200" hidden>
            <button type="button" onclick="selectPrice('price-200', '～1000万円', this)">～1000万円</button>
          </label>
          <label>
            <input type="radio" name="price" value="over" id="price-200over" hidden>
            <button type="button" onclick="selectPrice('price-200over', '1000万円～', this)">1000万円～</button>
          </label>
        </div>
        <!-- もし価格が選択されていなければこれを表示 -->
        <div class="select-color" id="selected-price">
          <p>選択された価格: なし</p>
        </div>
      </div>
    </div>


    <!-- ボディタイプ -->
    <div class="body-tail">
      <div class="search-body-card">
        <div class="title">
          <h2>ボディタイプ</h2>
        </div>
        <div class="body-type">
          <label>
            <input type="checkbox" name="bodytype[]" value="'セダン'">
            <img src="../img/セダン.png" alt="セダン" width="30px">
            <span>セダン</span>
          </label>
          <label>
            <input type="checkbox" name="bodytype[]" value="'SUV'">
            <img src="../img/SUV.png" alt="SUV" width="30px">
            <span>SUV</span>
          </label>
          <label>
            <input type="checkbox" name="bodytype[]" value="'スポーツカー'">
            <img src="../img/スポーツカー.png" alt="スポーツカー" width="40px">
            <span>スポーツカー</span>
          </label>
        </div>
      </div>
    </div>


    <!-- カラー -->
    <div class="color-tail">
      <div class="search-color-card">
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
      </div>
    </div>

    <div class="search-submit" id="search-submit">
      <input type="submit" value="この条件で絞り込む">
    </div>
  </div>


  <!-- 絞り込み内容を一括送信するためここにform終了タグ -->
</form>

<!-- 車のリスト -->
<?php
//以下絞り込み検索のSQL文を組み立てるコード
if (isset($_GET['s'])) {
  //echo '絞り込み検索リクエストを確認、条件部分のSQL文を初期化';
  $suffix = '';
  $first = true;
  if (isset($_GET['brands'])) {
    //echo 'brandsパラメータの存在を確認';
    $brands = $_GET['brands'];
    $suffix .= 'brand IN(' . implode(',', $brands) . ') ';
    $first = false;
  }

  if (isset($_GET['price'])) {
    //echo 'priceパラメータの存在を確認';
    $price = $_GET['price'];
    if (!$first) {
      $suffix .= 'AND ';
    }
    if ($price == 'over') {
      $suffix .= 'price >= 10000000 ';
      $first = false;
    } else {
      $suffix .= 'price <= ' . $price . ' ';
      $first = false;
    }
  }

  if (isset($_GET['bodytype'])) {
    //echo 'bodytypeパラメータの存在を確認';
    if (!$first) {
      $suffix .= 'AND ';
    }
    $bodytype = $_GET['bodytype'];
    $suffix .= 'body_type IN(' . implode(',', $bodytype) . ') ';
    $first = false;
  }
  if (isset($_GET['color'])) {
    //echo 'colorパラメータの存在を確認';
    if (!$first) {
      $suffix .= 'AND ';
    }
    $color = $_GET['color'];
    $suffix .= 'color IN(' . implode(',', $color) . ')';
    $first = false;
  }
  if ($first) {
    $suffix .= '1=1';
  }

  $suffix .= ';';

  //以上絞り込み検索のSQL文を組み立てるコード
  //以下条件に合致する車の情報を取得するコード
  $sql = 'SELECT car_id, car_name, price FROM car WHERE ';
  $sql .= $suffix;
  require_once '../DBconnect.php';
  $pdo = getDB();
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $cars = $stmt->fetchall(PDO::FETCH_ASSOC);
  if (empty($cars)) {
    echo <<<ERR
      <div class="car-not-found">
        <h2>検索条件に一致する車が見つかりませんでした。</h2>
      </div>
    ERR;
    die();
  }
  //以上条件に合致する車の情報を取得するコード
  //以下取得した車情報からメイン画像を取得するコード
  $imageid = [];
  foreach ($cars as $row) {
    $imageid[] = $row['car_id'];
  }
  $sql = 'SELECT car_id, image FROM image WHERE is_primary = 1 AND car_id IN(';
  $placeholder = implode(',', $imageid);
  $sql .= $placeholder;
  $sql .= ');';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $images = $stmt->fetchall(PDO::FETCH_ASSOC);
  //以上取得した車情報からメイン画像を取得するコード
  //以下検索結果を実際に画面に出力するコード
  echo '<div class="car-list">';
  $c = 0;
  foreach ($cars as $row) {
    echo '<a href="https://aso2301389.hippy.jp/carselect/member/car_detail?item=' . $row['car_id'] . '" class="car-item">'; // aタグを全体に適用
    echo '<img src="' . $images[$c]['image'] . '" alt="' . $row['car_name'] . '">';
    echo '<div class="car-info">';
    echo '<div class="search-car-date"><h3>' . $row['car_name'] . '</h3>';
    echo '<div class="separator"></div>';
    echo '<p>' . number_format($row['price']) . '円</p>';
    if (!empty($_SESSION['id'])) {
      if (chkFavItem($_SESSION['id'],$row['car_id'])) {
        echo '<form action="FavListEditer.php" method="post">';
          echo '<input type="hidden" name="car_id" value="'.$row['car_id'].'">';
          echo '<input type="hidden" name="action" value="del">';
          echo '<input type="hidden" name="url" value="'. $_SERVER['REQUEST_URI'].'">';
          echo '<button type="submit" class="iine">';
            echo '<i class="fas fa-heart" style="color:#FF0000;"></i><!-- <img src="icon.png" alt="Submit" style="width: 24px; height: 24px;"> -->';
          echo '</button>';
        echo '</form>';
      } else {
        echo '<form action="FavListEditer.php" method="post">';
        echo '<input type="hidden" name="car_id" value="'.$row['car_id'].'">';
        echo '<input type="hidden" name="action" value="add">';
        echo '<input type="hidden" name="url" value="'. $_SERVER['REQUEST_URI'].'">';
          echo '<button type="submit" class="iine">';
            echo '<i class="far fa-heart" style="color:#FF0000;"></i><!--<img src="icon.png" alt="Submit" style="width: 24px; height: 24px;"> -->';
          echo '</button>';
        echo '</form>';
      }
    } else {
      echo '<form action="login.php" method="get">';
        echo '<button type="submit" class="iine">';
          echo '<i class="far fa-heart" style="color:#FF0000;"></i><!--<img src="icon.png" alt="Submit" style="width: 24px; height: 24px;"> -->';
        echo '</button>';
      echo '</form>';
    }
    
    echo '</div></div>';
    echo '</a>'; // aタグを閉じる
    $c++;
  }
  echo '</div>';
  //以上検索結果を実際に画面に出力するコード
  //他ページからの検索処理時に検索結果の場所に自動スクロールさせるJS
  echo <<<SCROLL
      <script>
          window.onload = function() {
              const target = document.getElementById('search-submit');
              target.scrollIntoView({ behavior: 'smooth' });
          };
      </script>
  SCROLL;
  
//以下トップページからのブランド検索時の検索処理
}elseif (isset($_GET['b'])) {
  $brand=$_GET['brand'];
  $sql = 'SELECT car_id, car_name, price FROM car WHERE brand = ? ;';
  require_once '../DBconnect.php';
  $pdo = getDB();
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$brand]);
  $cars = $stmt->fetchall(PDO::FETCH_ASSOC);
  if (empty($cars)) {
    echo <<<ERR
      <div class="car-not-found">
        <h2>検索条件に一致する車が見つかりませんでした。</h2>
      </div>
    ERR;
    die();
  }
  $imageid = [];
  foreach ($cars as $row) {
    $imageid[] = $row['car_id'];
  }
  $sql = 'SELECT car_id, image FROM image WHERE is_primary = 1 AND car_id IN(';
  $placeholder = implode(',', $imageid);
  $sql .= $placeholder;
  $sql .= ');';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $images = $stmt->fetchall(PDO::FETCH_ASSOC);

  echo '<div class="car-list" id="car-list">';
  $c = 0;
  foreach ($cars as $row) {
    echo '<a href="https://aso2301389.hippy.jp/carselect/member/car_detail?item=' . $row['car_id'] . '" class="car-item">'; // aタグを全体に適用
    echo '<img src="' . $images[$c]['image'] . '" alt="' . $row['car_name'] . '">';
    echo '<div class="car-info">';
    echo '<div class="search-car-date"><h3>' . $row['car_name'] . '</h3>';
    echo '<div class="separator"></div>';
    echo '<p>¥' . number_format($row['price']) . '</p>';
    if (!empty($_SESSION['id'])) {
      if (chkFavItem($_SESSION['id'],$row['car_id'])) {
        echo '<form action="FavListEditer.php" method="post">';
          echo '<input type="hidden" name="car_id" value="'.$row['car_id'].'">';
          echo '<input type="hidden" name="action" value="del">';
          echo '<input type="hidden" name="url" value="'. $_SERVER['REQUEST_URI'].'">';
          echo '<button type="submit" class="iine">';
            echo '<i class="fas fa-heart" style="color:#FF0000;"></i><!-- <img src="icon.png" alt="Submit" style="width: 24px; height: 24px;"> -->';
          echo '</button>';
        echo '</form>';
    } else {
        echo '<form action="FavListEditer.php" method="post">';
        echo '<input type="hidden" name="car_id" value="'.$row['car_id'].'">';
        echo '<input type="hidden" name="action" value="add">';
        echo '<input type="hidden" name="url" value="'. $_SERVER['REQUEST_URI'].'">';
          echo '<button type="submit" class="iine">';
            echo '<i class="far fa-heart" style="color:#FF0000;"></i><!--<img src="icon.png" alt="Submit" style="width: 24px; height: 24px;"> -->';
          echo '</button>';
        echo '</form>';
    }
    } else {
      echo '<form action="login.php" method="get">';
        echo '<button type="submit" class="iine">';
          echo '<i class="far fa-heart" style="color:#FF0000;"></i><!--<img src="icon.png" alt="Submit" style="width: 24px; height: 24px;"> -->';
        echo '</button>';
      echo '</form>';
    }
    echo '</div></div>';
    echo '</a>'; // aタグを閉じる
    $c++;
  }
  echo '</div>';

  echo <<<SCROLL
      <script>
          window.onload = function() {
              const target = document.getElementById('search-submit');
              target.scrollIntoView({ behavior: 'smooth' });
          };
      </script>
  SCROLL;

}
?>


<!-- ページ最上部へ戻るボタン -->
<button id="back-to-top" style="display: none;">↑ Top</button>

<div class="null-box"></div>
<script src="../js/search.js"></script>
<script>
  //ページ最上部へ戻るボタン
// ボタンの要素を取得
const backToTopButton = document.getElementById('back-to-top');

// スクロール時にボタンの表示を切り替え
window.addEventListener('scroll', () => {
  if (window.scrollY > 1000) { // 1000px以上スクロールしたら表示
    backToTopButton.style.display = 'block';
  } else {
    backToTopButton.style.display = 'none';
  }
});

// ボタンをクリックした際にページ上部にスクロール
backToTopButton.addEventListener('click', () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth' // スムーズなスクロール
  });
});
</script>
</body>

</html>