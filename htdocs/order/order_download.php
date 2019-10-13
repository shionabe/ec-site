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

require_once('../common/common.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>アニメグッズ</title>
  </head>
  <body>

    ダウンロードしたい注文日を選択して下さい。<br/>
    <form method="post" action="order_download_done.php">
      <select name="year">
        <?php pulldown_year(); ?>
      </select>
      年
      <select name="month">
        <?php pulldown_month(); ?>
      </select>
      月
      <select name="day">
        <?php pulldown_day(); ?>
      </select>
      日<br/>
      <br/>
      <input type="submit" value="ダウンロード">
      <input type="button" onclick="history.back()" value="戻る">
    </form>

  </body>
</html>
