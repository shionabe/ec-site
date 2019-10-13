
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
      <title>アニメグッズ</title>
    </head>
    <body>
      住所追加<br/>
      <br/>
      <form method="post" action="shop_address_add_check.php" enctype="multipart/form-data">
        郵便番号<br/>
        <input type="text" name="subpostal1" style="width:60px" value="" placeholder="半角数字">-
        <input type="text" name="subpostal2" style="width:80px" value="" placeholder="半角数字"><br/>
        住所<br/>
        <input type="text" name="subaddress" style="width:500px"><br/>

        <br/>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
      </form>
    </body>
</html>
