<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>アニメグッズ</title>
  </head>
  <body>
    <?php

        try{
            $opu_code = $_GET['opuscode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name,text,gazou FROM work WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $opu_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $opu_name = $rec['name'];
            $opu_text = $rec['text'];
            $opu_gazou_name = $rec['gazou'];

            $dbh = null;

              if($opu_gazou_name==''){
                $disp_gazou='';
              }else{
                $disp_gazou='<img src="./gazou/'.$opu_gazou_name.'">';
              }

            }
            catch(Exception $e){
                echo 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

        ?>

        作品情報参照<br/>
        <br/>
        作品コード<br/>
        <?php echo $opu_code; ?>
        <br/>
        作品名<br/>
        <?php echo $opu_name;?>
        <br/>
        作品説明<br/>
        <?php echo $opu_text;?>
        <br/>
        <?php echo $disp_gazou;?>
        <br/>
        <br/>
        <form>
            <input type="button" onclick="history.back()" value="戻る">
        </form>

  </body>
</html>
