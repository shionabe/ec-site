<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>購入履歴</title>
    </head>
    <body>
      <?php

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
          WHERE 1
          ';

          $stmt = $dbh->prepare($sql);
          $stmt->execute();

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
      <a href="../staff_login/staff_top.php">トップメニューへ</a><br/>

    </body>
</html>
