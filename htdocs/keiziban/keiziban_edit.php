

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>掲示板</title>
  </head>
  <body>
        <?php

        try{
          
            $keiziban_code =$_GET['keizibancode'];

            $dsn = 'mysql:dbname=keiziban;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name,textile FROM guest WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $keiziban_code;
            $stmt->execute($data);


            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $keiziban_name = $rec['name'];
            $keiziban_textile = $rec['textile'];


            $dbh = null;

          }
            catch(Exception $e){
                echo 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();

        }

        ?>
        <br/>
        <h2>秘密の掲示板</h2>
        <br/>
        前言撤回する<br/>
        <br/>
        <form method ="post" action="keiziban_edit_check.php" enctype="multipart/form-data">
            <input type="hidden" name="keizibancode" value="<?php echo $keiziban_code;?>">
            お名前<br/>
            <input type="text" name="name" style="width:200px" value="<?php echo $keiziban_name; ?>">
            <br/>
            内容<br/>
            <input type="text" name="textile" style="width:200px" value="<?php echo $keiziban_textile;?>"><br/>
            <br/>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="編集完了">
        </form>
  </body>
</html>
