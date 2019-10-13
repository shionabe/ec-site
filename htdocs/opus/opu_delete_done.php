
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>アニメグッズ</title>
  </head>
  <body>
    <?php

            try{
                $opu_code = $_POST['code'];
                $opu_gazou_name = $_POST['gazou_name'];

                $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn,$user,$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql = 'DELETE FROM work WHERE code=?';
                $stmt = $dbh->prepare($sql);
                $data[] = $opu_code;
                $stmt->execute($data);

                $dbh = null;

                if($opu_gazou_name != ''){
                    unlink('./gazou/'.$opu_gazou_name);
                }

            }
            catch(Exception $e){
                print 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

            ?>

            削除しました。<br/>
            <br/>
            <a href="opu_list.php">戻る</a>
  </body>
</html>
