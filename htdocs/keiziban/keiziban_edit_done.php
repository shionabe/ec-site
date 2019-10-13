
<?php

          if (isset($_POST["keizibancode"])) {
            echo $_POST["keizibancode"];
          }else{
            echo '';
          }
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>掲示板</title>
    </head>
    <body>
      <?php

      try{

          require_once('../common/common.php');

          $post=sanitize($_POST);
          // $keiziban_code =$_GET['keizibancode'];



          $keiziban_code=$post['keizibancode'];
          $keiziban_name = $post['name'];
          $keiziban_textile = $post['textile'];




          $dsn = 'mysql:dbname=keiziban;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'UPDATE guest SET name=?,textile=? WHERE code=?';
          $stmt = $dbh->prepare($sql);
          $data[] = $keiziban_name;
          $data[] = $keiziban_textile;
          $data[] = $keiziban_code;
          $stmt->execute($data);

          $dbh = null;

          echo '修正しました。<br/>';
      }
      catch(Exception $e){
          echo 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }
      ?>

      <a href="keiziban_list.php">戻る</a>

    </body>
</html>
