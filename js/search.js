function selectPrice(id) {
    // すべてのラジオボタンを解除
    document.querySelectorAll('.price-range input[type="radio"]').forEach((radio) => {
      radio.checked = false;
    });

    // 指定されたIDのラジオボタンをチェックする！
    document.getElementById(id).checked = true;

    // すべてのボタンから「selected」クラスを削除
    document.querySelectorAll('.price-range button').forEach((button) => {
      button.classList.remove('selected');
    });

    // 選択されたボタンに「selected」クラスを追加
    document.querySelector(`button[onclick="selectPrice('${id}')"]`).classList.add('selected');
  }