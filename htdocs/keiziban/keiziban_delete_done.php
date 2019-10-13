
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>掲示板</title>
  </head>
  <body>
    <?php

            try{
                $keiziban_code = $_POST['keizibancode'];
                // $keiziban_textile = $_POST['$textile']

                $dsn = 'mysql:dbname=keiziban;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn,$user,$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql = 'DELETE FROM guest WHERE code=?';
                $stmt = $dbh->prepare($sql);
                $data[] = $keiziban_code;
                $stmt->execute($data);

                $dbh = null;

            }
            catch(Exception $e){
                print 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

            ?>

            削除しました。<br/>
            <br/>
            <a href="keiziban_list.php">戻る</a>
  </body>
</html>
