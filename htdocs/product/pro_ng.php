<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
  echo 'ログインされていません。<br/>';
  echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
}else{
  echo $_SESSION['staff_name'];
  echo 'さんログイン中<br/>';
  echo '<br/>';
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>アニメグッズ</title>
  </head>
  <body>

    商品が選択されていません。<br/>
    <a href = "pro_list.php">戻る</a>

  </body>
</html>
