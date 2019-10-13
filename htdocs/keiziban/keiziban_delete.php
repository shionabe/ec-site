

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>掲示板</title>
  </head>
  <body>
    <?php

        try{
            $keiziban_code = $_GET['keizibancode'];

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
        投稿削除<br/>
        <br/>
        コード<br/>
        <?php echo $keiziban_code; ?>
        <br/>
        投稿内容
        <?php echo $keiziban_name; ?>
        <br/>
        <?php echo $keiziban_textile; ?>
        <br/>
        この投稿を削除してよろしいですか？<br/>
        <br/>
        <form method ="post" action="keiziban_delete_done.php">
            <input type="hidden" name="code" value="<?php echo $keiziban_code;?>">
            <input type="hidden" name="textile" value="<?php echo $keiziban_textile;?>">

            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
  </body>
</html>
