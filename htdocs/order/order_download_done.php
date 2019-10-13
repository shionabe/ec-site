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
      <?php

      try{

          $year=$_POST['year'];
          $month=$_POST['month'];
          $day=$_POST['day'];

          $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'SELECT
                    dat_sales.code,
                    dat_sales.date,
                    dat_sales.code_member,
                    dat_sales.name AS dat_sales_name,
                    dat_sales.email,
                    dat_sales.postal1,
                    dat_sales.postal2,
                    dat_sales.address,
                    dat_sales.tel,
                    dat_sales_product.code_product,
                    product.name AS product_name,
                    dat_sales_product.price,
                    dat_sales_product.quantity
                  FROM
                    dat_sales,dat_sales_product,product
                  WHERE
                    dat_sales.code=dat_sales_product.code_sales
                    AND dat_sales_product.code_product=product.code
                    AND substr(dat_sales.date,1,4)=?
                    AND substr(dat_sales.date,6,2)=?
                    AND substr(dat_sales.date,9,2)=?
                  ';
          $stmt = $dbh->prepare($sql);
          $data[]=$year;
          $data[]=$month;
          $data[]=$day;
          $stmt->execute($data);
          // $stmt->execute([$year]);
          // $stmt->execute([$month]);
          // $stmt->execute([$day]);
          // の意味


          $dbh = null;

          $csv='注文コード,注文日時,会員番号,氏名,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
          $csv.="\n";
          while(true){
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            if($rec==false){
              break;
            }
            $csv.=$rec['code'];
            $csv.=',';
            $csv.=$rec['date'];
            $csv.=',';
            $csv.=$rec['code_member'];
            $csv.=',';
            $csv.=$rec['dat_sales_name'];
            $csv.=',';
            $csv.=$rec['email'];
            $csv.=',';
            $csv.=$rec['postal1'].'-'.$rec['postal2'];
            $csv.=',';
            $csv.=$rec['address'];
            $csv.=',';
            $csv.=$rec['tel'];
            $csv.=',';
            $csv.=$rec['code_product'];
            $csv.=',';
            $csv.=$rec['product_name'];
            $csv.=',';
            $csv.=$rec['price'];
            $csv.=',';
            $csv.=$rec['quantity'];
            $csv.="\n";
          }
          // echo nl2br($csv);
          $file=fopen("./chumon.$year-$month-$day.csv",'w');
          $csv=mb_convert_encoding($csv,'SJIS','UTF-8');
          fputs($file,$csv);
          fclose($file);
      }

      catch(Exception $e){
          echo 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }

      ?>

      ダウンロードしました。
      <br/>
      <a href="../staff_login/staff_top.php">トップメニューへ</a><br/>

    </body>
</html>
