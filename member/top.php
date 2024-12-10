<?php require('../header/header.php'); ?>
  <ul class="slider">
    <li class="slider-item slider-item01"></li>
    <li class="slider-item slider-item02"></li>
    <li class="slider-item slider-item03"></li>
  </ul>

  <form class="car-logo-back" action="search.php" method="get">
    <!-- トップページからのブランド検索であることを通知する変数 -->
    <input type="hidden" name="b">
    <input type="hidden" name="brand" id="sendbrand" value="">
    <div class="car-logo">
        <div class="car-logo-item">
            <input type="image" name="stub" value="レクサス" src="../img/Lexus.png" alt="Lexus" onclick="setBrandInfo('レクサス')">
        </div>
        <div class="car-logo-item">
            <input type="image" name="stub" value="日産" src="../img/Nissan.png" alt="Nissan" onclick="setBrandInfo('日産')">
        </div>
        <div class="car-logo-item">
            <input type="image" name="stub" value="マツダ" src="../img/Mazda.png" alt="Mazda" onclick="setBrandInfo('マツダ')">
        </div>
        <div class="car-logo-item">
            <input type="image" name="stub" value="トヨタ" src="../img/Toyota.png" alt="Toyota" onclick="setBrandInfo('トヨタ')">
        </div>
        <div class="car-logo-item">
            <input type="image" name="stub" value="ホンダ" src="../img/Honda.png" alt="Honda" onclick="setBrandInfo('ホンダ')">
        </div>
    </div>
    <div class="car-logo2">
        <div class="car-logo-item">
            <input type="image" name="stub" value="ポルシェ" src="../img/Porsche.png" alt="Porsche" onclick="setBrandInfo('ポルシェ')">
        </div>
        <div class="car-logo-item">
            <input type="image" name="stub" value="ベンツ" src="../img/Benz.png" alt="Benz" onclick="setBrandInfo('ベンツ')">
        </div>
        <div class="car-logo-item">
            <input type="image" name="stub" value="ランボルギーニ" src="../img/Lamborghini.png" alt="Lamborghini" onclick="setBrandInfo('ランボルギーニ')">
        </div>
        <div class="car-logo-item">
            <input type="image" name="stub" value="BMW" src="../img/BMW.png" alt="BMW" onclick="setBrandInfo('BMW')">
        </div>
        <div class="car-logo-item">
            <input type="image" name="stub" value="フェラーリ" src="../img/Ferrari.png" alt="Ferrari" onclick="setBrandInfo('フェラーリ')">
        </div>
    </div>
</form>


<script>
  function setBrandInfo(value) {
    document.getElementById('sendbrand').value = value;
  }
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="../js/slide.js"></script>
</body>
</html>
