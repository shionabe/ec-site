
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

          $opu_name = $post['name'];
          $opu_text = $post['text'];
          $opu_genre = $post['genre'];
          $opu_gazou_name = $_POST['gazou_name'];
          $opu_txt1=$post['txt1'];
          $opu_txt2=$post['txt2'];
          $opu_txt3=$post['txt3'];
          $opu_txt4=$post['txt4'];
          // ここがFILEだった時にどう表示されるのか実験
          $opu_pic1=$_FILES['pic1'];
          $opu_pic2=$_FILES['pic2'];
          $opu_pic3=$_FILES['pic3'];
          $opu_pic4=$_FILES['pic4'];

          $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'INSERT INTO work(name,text,genre,gazou,txt1,txt2,txt3,txt4,pic1,pic2,pic3,pic4) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
          $stmt = $dbh->prepare($sql);
          $data[] = $opu_name;
          $data[] = $opu_text;
          $data[] = $opu_genre;
          $data[] = $opu_gazou_name;
          $data[] = $opu_txt1
          $data[] = $opu_txt2
          $data[] = $opu_txt3
          $data[] = $opu_txt4
          $data[] = $opu_pic1
          $data[] = $opu_pic2
          $data[] = $opu_pic3
          $data[] = $opu_pic4

          $stmt->execute($data);

          $dbh = null;

          echo $opu_name;
          echo 'を追加しました。<br/>';
      }
      catch(Exception $e){
          echo 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }
      ?>

      <a href="opu_list.php">戻る</a>

    </body>
</html>
