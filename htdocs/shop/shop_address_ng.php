
<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false){
  echo 'ようこそゲスト様　';
  echo '<a href="member_login.html">会員ログイン</a><br/>';
  echo '<br/>';
}else{
  echo 'ようこそ';
  echo $_SESSION['member_name'];
  echo '様　';
  echo '<a href="member_logout.php">ログアウト</a><br/>';
  echo '<br/>';
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>サイトタイトル</title>
  </head>
  <body>

    住所を選択してください。<br/>
    <a href = "shop_cartlook.php">戻る</a>

  </body>
</html>
