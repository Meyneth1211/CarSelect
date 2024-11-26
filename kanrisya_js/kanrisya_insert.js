// メイン画像のプレビュー表示
document.getElementById("main_image").addEventListener("change", function (event) {
    const preview = document.getElementById("main_image_preview");
    const file = event.target.files[0];

    // プレビューエリアをクリア
    preview.innerHTML = "";

    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const img = document.createElement("img");
        img.src = e.target.result;
        preview.appendChild(img);
      };
      reader.readAsDataURL(file);
    } else {
      preview.innerHTML = "<p>画像ファイルではありません</p>";
    }
  });

  // その他の画像のプレビュー表示
  document.getElementById("other_images").addEventListener("change", function (event) {
    const preview = document.getElementById("other_images_preview");
    const files = event.target.files;

    // プレビューエリアをクリア
    preview.innerHTML = "";

    if (files.length === 0) {
      preview.innerHTML = "<p>画像が選択されていません</p>";
      return;
    }

    // 各ファイルを処理してプレビューに表示
    Array.from(files).forEach(file => {
      if (file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = document.createElement("img");
          img.src = e.target.result;
          preview.appendChild(img);
        };
        reader.readAsDataURL(file);
      } else {
        const message = document.createElement("p");
        message.textContent = `${file.name} は画像ファイルではありません`;
        preview.appendChild(message);
      }
    });
  });
