<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>アニメグッズ</title>
    </head>
    <body>
      <?php

      try{
          $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'SELECT code,name,text FROM work WHERE 1';
          $stmt = $dbh->prepare($sql);
          $stmt->execute();

          $dbh = null;

          echo '作品一覧<br/><br/>';

          echo '<form method="post" action="opu_branch.php">';

          while(true){
              $rec = $stmt->fetch(PDO::FETCH_ASSOC);
              if($rec == false){
                  break;
              }
              echo '<input type="radio" name="opuscode" value="'.$rec['code'].'">';
              echo $rec['name'].'---';
              echo '<br/>';
              echo $rec['text'].'---';
              echo '<br/>';
          }
          echo '<input type="submit" name="disp" value="参照">';
          echo '<input type="submit" name="add" value="追加">';
          echo '<input type="submit" name="edit" value="修正">';
          echo '<input type="submit" name="delete" value="削除">';
          echo '</form>';
      }

      catch(Exception $e){
          echo 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }

      ?>

      <br/>
      <a href="../staff_login/staff_top.php">トップメニューへ</a><br/>

    </body>
</html>
