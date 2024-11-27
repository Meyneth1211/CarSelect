<?php
    header("Content-Type: text/css");

    $item = $_GET['item'];
    require_once '../DBconnect.php';
    $pdo = getDB();
    $sql = "SELECT COUNT(*) FROM image WHERE car_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$item]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['COUNT(*)'];

    $sql="SELECT image FROM image WHERE car_id = ? ORDER BY is_primary DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$item]);
    $image = $stmt->fetchall(PDO::FETCH_ASSOC);

    for ($i = 0; $i < $count; $i++) {
        echo '.slider-item' . $i . ' {';
            echo 'background:url(' . $image[$i]['image'] . ');';
        echo '}';
    }

    $pdo=null;
?>


.slider {
    position:relative;
      z-index: 1;
      /*↑z-indexの値をh1のz-indexの値よりも小さくして背景に回す*/
      height: 84vh;/*スライダー全体の縦幅を画面の高さいっぱい（100vh）にする*/
  }
  
  .slider-item {
      width: 100%;/*各スライダー全体の横幅を画面の高さいっぱい（100%）にする*/
      height:84vh;/*各スライダー全体の縦幅を画面の高さいっぱい（100vh）にする*/
      background-repeat: no-repeat;/*背景画像をリピートしない*/
      background-position: center;/*背景画像の位置を中央に*/
      background-size: cover;/*背景画像が.slider-item全体を覆い表示*/
  }
  
  /*矢印の設定*/
  
  .slick-prev, 
  .slick-next {
      position: absolute;
      z-index: 3;
      top: 42%;
      cursor: pointer;/*マウスカーソルを指マークに*/
      outline: none;/*クリックをしたら出てくる枠線を消す*/
      border-top: 2px solid #fff;/*矢印の色*/
      border-right: 2px solid #fff;/*矢印の色*/
      height: 25px;
      width: 25px;
  }
  
  .slick-prev {/*戻る矢印の位置と形状*/
      left:2.5%;
      transform: rotate(-135deg);
  }
  
  .slick-next {/*次へ矢印の位置と形状*/
      right:2.5%;
      transform: rotate(45deg);
  }
  
  /*ドットナビゲーションの設定*/
  
  .slick-dots {
      position: relative;
      z-index: 3;
      text-align:center;
      margin:-50px 0 0 0;/*ドットの位置*/
  }
  
  .slick-dots li {
      display:inline-block;
      margin:0 5px;
  }
  
  .slick-dots button {
      color: transparent;
      outline: none;
      width:8px;/*ドットボタンのサイズ*/
      height:8px;/*ドットボタンのサイズ*/
      display:block;
      border-radius:50%;
      background:#fff;/*ドットボタンの色*/
  }
  
  .slick-dots .slick-active button{
      background:#333;/*ドットボタンの現在地表示の色*/
  }