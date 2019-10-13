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
        <?php

          require_once('../common/common.php');

          $post=sanitize($_POST);

          $shop_subpostal1=$post['subpostal1'];
          $shop_subpostal2=$post['subpostal2'];
          $shop_subaddress=$post['subaddress'];


          if(preg_match("/^[0-9]+$/",$shop_subpostal1 || $shop_subpostal2) == 0){
            echo '半角数字で入力してください。<br/>';
          }else{
            echo '郵便番号：';
            echo $shop_subpostal1;
            echo '-';
            echo $shop_subpostal2;
            }

          if($shop_subaddress == ''){
              echo '住所が入力されていません。<br/>';
          }else{
              echo '住所：';
              echo $shop_subaddress;
              echo '<br/>';
              }



          if($shop_subaddress == '' || preg_match("/^[0-9]+$/",$shop_subpostal1 || $shop_subpostal2) == 0 ){
              echo '<form>';
              echo '<input type="button" onclick="history.back()" value="戻る">';
              echo '</form>';
          }else{
              echo '上記の住所を追加します。<br/>';
              echo '<form method="post" action="shop_address_add_done.php">';

              echo '<input type="hidden" name="subpostal1" value="'.$shop_subpostal1.'">';
              echo '-';
              echo '<input type="hidden" name="subpostal2" value="'.$shop_subpostal2.'">';
              echo '<input type="hidden" name="subaddress" value="'.$shop_subaddress.'">';

              echo '<br/>';
              echo '<input type="button" onclick="history.back()" value="戻る">';
              echo '<input type="submit" value="OK">';
              echo '</form>';
          }
        ?>
    </body>
</html>
