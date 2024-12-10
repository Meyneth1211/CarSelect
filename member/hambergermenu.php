<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hamburger Menu</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #000;
  color: #fff;
}

.menu-container {
  width: 300px;
  height: 100vh;
  background-color: #333;
  display: flex;
  flex-direction: column;
  padding: 20px;
  box-sizing: border-box;
}

.menu-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.menu-header h1 {
  font-size: 24px;
  margin: 0;
}

.close-button {
  background: none;
  border: none;
  color: #fff;
  font-size: 24px;
  cursor: pointer;
}

.menu-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.menu-list li {
  position: relative;
  text-align: center;
}

.menu-list li::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 10%;
  right: 10%;
  height: 2px;
  background: linear-gradient(to right, #fff, #666, #fff);
}

.menu-list li::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 0;
  height: 10px;
  width: 10px;
  background-color: #fff;
  border-radius: 50%;
  transform: translateY(-50%);
}

.menu-list li:last-child::before {
  display: none; /* 最後の項目には線を表示しない */
}

.menu-list li:last-child::after {
  display: none; /* 最後の項目の円を非表示 */
}

.menu-list a {
  text-decoration: none;
  color: #fff;
  font-size: 18px;
  padding: 10px;
  border: 1px solid transparent;
  display: inline-block;
}

.menu-list a:hover {
  border: 1px solid #fff;
}

.login-button {
  border: 1px solid #fff;
  padding: 10px 20px;
  font-size: 16px;
}
  </style>
</head>
<body>
  <div class="menu-container">
    <div class="menu-header">
      <h1>Car Select</h1>
      <button class="close-button">&times;</button>
    </div>
    <ul class="menu-list">
      <li><a href="#">TOP</a></li>
      <li><a href="#">SEARCH</a></li>
      <li><a href="#">FAVORITE</a></li>
      <li><a href="#">ACCOUNT</a></li>
      <li><a href="#">LOGOUT</a></li>
      <li><a href="#" class="login-button">LOGIN</a></li>
    </ul>
  </div>
</body>
</html>