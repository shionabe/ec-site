<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>掲示板</title>
    </head>
    <body>
      <br/>
      <h2>秘密の掲示板</h2>
      <p>何をつぶやく？</p>
      <form method="post" action="keiziban_add_check.php" enctype="multipart/form-data" >
        お名前<br/>
        <input type="text" name="name" style="width:200px"><br/>
        もの申したいこと<br/>
        <input type="text" name="textile" style="width:200px"><br/> <br/>
        <input type="submit" value="つぶやく">
        <br/>
        <br/>
      </form>
      <?php

      try{
          $dsn = 'mysql:dbname=keiziban;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'SELECT code,name,textile FROM guest WHERE 1';
          $stmt = $dbh->prepare($sql);
          $stmt->execute();

          $dbh = null;


          echo '<form method="post" action="keiziban_branch.php">';

          while(true){
              $rec = $stmt->fetch(PDO::FETCH_ASSOC);
              if($rec == false){
                  break;
              }

              echo '<input type="radio" name="keizibancode" value="'.$rec['code'].'">';
              echo $rec['name'].'さん';
              echo '<br/>';
              echo $rec['textile'];
              echo '<br/>';
              echo '<input type="submit" name="edit" value="編集">';
              echo '<input type="submit" name="delete" value="削除">';
              echo '<br/>';
          }
          // echo '<input type="submit" name="disp" value="参照">';
          // echo '<input type="submit" name="add" value="追加">';

          echo '</form>';
      }

      catch(Exception $e){
          echo 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }

      ?>

      <br/>
      <!-- <a href="../staff_login/staff_top.php">トップメニューへ</a><br/> -->
      <input type="button" onclick="history.back()" value="戻る">
    </body>
</html>
