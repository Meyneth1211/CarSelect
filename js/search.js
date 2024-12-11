function selectPrice(id, priceLabel, buttonElement) {
    // すべてのラジオボタンを解除
    document.querySelectorAll('.price-range input[type="radio"]').forEach((radio) => {
      radio.checked = false;
    });

    // 指定されたIDのラジオボタンをチェック!
    const selectedRadio = document.getElementById(id);
    selectedRadio.checked = true;

    // すべてのボタンから「selected」クラスを削除
    document.querySelectorAll('.price-range button').forEach((button) => {
      button.classList.remove('selected');
    });

    // 選択されたボタンに「selected」クラスを追加
    buttonElement.classList.add('selected');

    // 選択された価格を表示
    document.getElementById('selected-price').innerText = `選択された価格: ${priceLabel}`;
    document.getElementById('selected-price').style.color = "#fff";  // フォント色の変更
  }
