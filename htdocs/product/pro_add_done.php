
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>アニメグッズ</title>
    </head>
    <body>
      <?php

      try{

          require_once('../common/common.php');

          $post=sanitize($_POST);

          $pro_name = $post['name'];
          $pro_price = $post['price'];
          $pro_genre = $post['genre'];
          $pro_gazou_name = $_POST['gazou_name'];

          $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'INSERT INTO product(name,price,genre,gazou) VALUES (?,?,?,?)';
          $stmt = $dbh->prepare($sql);
          $data[] = $pro_name;
          $data[] = $pro_price;
          $data[] = $pro_genre;
          $data[] = $pro_gazou_name;
          $stmt->execute($data);

          $dbh = null;

          echo $pro_name;
          echo 'を追加しました。<br/>';
      }
      catch(Exception $e){
          echo 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }
      ?>

      <a href="pro_list.php">戻る</a>

    </body>
</html>
