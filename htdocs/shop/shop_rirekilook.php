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
  echo '<a href="shop_rirekilook.php">購入履歴を見る</a><br/>';
  echo '<br/>';
}

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>購入履歴</title>
    </head>
    <body>
      <?php

      $code=$_SESSION['member_code'];

      try{
          $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'SELECT product.code,product.name,product.gazou,dat_sales_product.price
          FROM product
          JOIN dat_sales_product
          ON product.code = dat_sales_product.code_sales
          JOIN dat_sales
          ON dat_sales.code = dat_sales_product.code_sales
          JOIN dat_member
          ON dat_sales.code_member = dat_member.code
          WHERE dat_member.code=?
          ';

          $stmt = $dbh->prepare($sql);
          $data[]=$code;
          $stmt->execute($data);

          $dbh = null;

          print '購入履歴<br/><br/>';
          //
          // print '<form method="post" action="staff_branch.php">';

          while(true){
              $rec = $stmt->fetch(PDO::FETCH_ASSOC);
              if($rec == false){
                  break;
              }
              print '<input type="radio" name="productcode" value="'.$rec['code'].'">';
              print $rec['name'];
              print '<br/>';
              print $rec['price']."円";

              print '<br/>';
              // print $rec['gazou'];
              if($rec['gazou']==''){
                print $rec['gazou']='';
              }else{
                print $rec['gazou']='<img src="../product/gazou/'.$rec['gazou'].'">';
              }


              print '<br/>';
          }
          // print '<input type="submit" name="disp" value="参照">';
          // print '<input type="submit" name="add" value="追加">';
          // print '<input type="submit" name="edit" value="修正">';
          // print '<input type="submit" name="delete" value="削除">';
          // print '</form>';
      }

      catch(Exception $e){
          print 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }

      ?>

      <br/>
      <a href="../shop/shop_list.php">トップメニューへ</a><br/>

    </body>
</html>
