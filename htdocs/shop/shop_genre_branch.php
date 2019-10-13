<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false){
  echo 'ようこそゲスト様　';
  echo '<a href="member_login.html">会員ログイン</a>  ';
  echo '<a href="guest_add.html">会員登録</a><br/>';
  echo '<br/>';
}else{
  echo 'ようこそ';
  echo $_SESSION['member_name'];
  echo '様　';
  echo '<a href="member_logout.php">ログアウト</a><br/>';
  echo '<a href="shop_rirekilook.php">購入履歴を見る</a><br/>';
  echo '</div></div>';
  echo '</form>';

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
          if(isset($_POST['change'])==true){
             $select=$_POST['select'];
              header('Location:shop_list.php?select='.$select);
       }
        catch(Exception $e){
        echo 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
        }


        if(isset($_POST['disp'])==true){
            if(isset($_POST['code'])==false){
              echo '商品が選択されていません。';
            }

            $code=$_POST['code'];
            header('Location:shop_disp.php?code='.$code);
            exit();
        }

  ?>



    </body>
</html>
