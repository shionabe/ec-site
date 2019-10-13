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

        try{

            $pro_code=$_GET['procode'];

            if(isset($_SESSION['cart'])==true){
              // もし、['cart']に一時的にデータが入っていたら
              $cart=$_SESSION['cart'];
              $kazu=$_SESSION['kazu'];
              if(in_array($pro_code,$cart)==true){
                // もしすでに入っていたら以下を実行
                echo 'その商品はすでにカートに入っています。<br/>';
                echo '<a href="shop_list.php">商品一覧に戻る</a>';
                exit();
              }
            }

            $cart[]=$pro_code;
            // 変数$cartには、$pro_codeを代入
            $kazu[]=1;
            // 変数$kazuには1個を代入
            $_SESSION['cart']=$cart;
            $_SESSION['kazu']=$kazu;
            // 一時的にデータを保存する
            }
            catch(Exception $e){
                echo 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

        ?>

        カートに追加しました。<br/>
        <br/>
        <a href="shop_list.php">商品一覧に戻る</a>

  </body>
</html>
