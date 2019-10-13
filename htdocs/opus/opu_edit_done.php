
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

          $opu_code = $post['code'];
          $opu_name = $post['name'];
          $opu_text = $post['text'];
          $opu_genre = $post['genre'];
          $opu_gazou_name_old=$_POST['gazou_name_old'];
          $opu_gazou_name=$_POST['gazou_name'];
          $opu_txt1=$post['txt1'];
          $opu_txt2=$post['txt2'];
          $opu_txt3=$post['txt3'];
          $opu_txt4=$post['txt4'];

          $opu_pic1_name_old=$_POST['pic1_name_old'];
          $opu_pic1_name=$_POST['pic1_name'];

          $opu_pic2_name_old=$_POST['pic2_name_old'];
          $opu_pic2_name=$_POST['pic2_name'];

          $opu_pic3_name_old=$_POST['pic3_name_old'];
          $opu_pic3_name=$_POST['pic3_name'];

          $opu_pic4_name_old=$_POST['pic4_name_old'];
          $opu_pic4_name=$_POST['pic4_name'];


          $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'UPDATE work SET name=?,text=?,genre=?,gazou=?,txt1=?,txt2=?,txt3=?,txt4=?,pic1=?,pic2=?,pic3=?,pic4=?,WHERE code=?';
          $stmt = $dbh->prepare($sql);
          $data[] = $opu_name;
          $data[] = $opu_text;
          $data[] = $opu_genre;
          $data[] = $opu_gazou_name;
          $data[] = $opu_code;
          $data[] = $opu_txt1;
          $data[] = $opu_txt2;
          $data[] = $opu_txt3;
          $data[] = $opu_txt4;
          $data[] = $opu_pic1_name;
          $data[] = $opu_pic2_name;
          $data[] = $opu_pic3_name;
          $data[] = $opu_pic4_name;
          // データが入力、追加されるときにこのコードを使う
          $stmt->execute($data);

          $dbh = null;
          // もし画像が更新されていたら変更してね
          if($opu_gazou_name_old != $opu_gazou_name){
            // もし画像が空欄だったら
            if($opu_gazou_name_old != ''){
              unlink('./gazou/'.$opu_gazou_name_old);
            }
          }

          if($opu_pic1_name_old != $opu_pic1_name){
            if($opu_pic1_name_old != ''){
              unlink('./gazou/'.$opu_pic1_name_old);
            }
          }
          if($opu_pic2_name_old != $opu_pic2_name){
            if($opu_pic2_name_old != ''){
              unlink('./gazou/'.$opu_pic2_name_old);
            }
          }
          if($opu_pic3_name_old != $opu_pic3_name){
            if($opu_pic3_name_old != ''){
              unlink('./gazou/'.$opu_pic3_name_old);
            }
          }
          if($opu_pic4_name_old != $opu_pic4_name){
            if($opu_pic4_name_old != ''){
              unlink('./gazou/'.$opu_pic4_name_old);
            }
          }

          echo '修正しました。<br/>';
      }
      catch(Exception $e){
          echo 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }
      ?>

      <a href="opu_list.php">戻る</a>

    </body>
</html>
