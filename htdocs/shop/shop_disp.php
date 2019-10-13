<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false){
  echo 'ようこそゲスト様　';
  echo '<a href="member_login.html">会員ログイン</a>  ';
  echo '<a href="guest_add.html">会員登録</a><br/>';
  echo '<br/>';
}else{
  echo 'ようこそ';
  echo $_SESSION['member_name'];
  echo '様　';
  echo '<a href="member_logout.php">ログアウト</a><br/>';
  echo '<a href="shop_rirekilook.php">購入履歴を見る</a><br/>';
  echo '</div></div>';
  echo '</form>';

  echo '<br/>';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>アニメグッズ</title>
  </head>
  <body>
    <?php

        try{
            $code = $_GET['code'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name,price,gazou FROM product WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $pro_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name = $rec['name'];
            $pro_price = $rec['price'];
            $pro_gazou_name = $rec['gazou'];

            $dbh = null;

              if($pro_gazou_name==''){
                $disp_gazou='';
              }else{
                $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
              }

            }
            catch(Exception $e){
                echo 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

        ?>

        商品情報参照<br/>
        <br/>
        商品コード<br/>
        <?php echo $pro_code; ?>
        <br/>
        商品名<br/>
        <?php echo $pro_name;?>
        <br/>
        価格<br/>
        <?php echo $pro_price;?>円
        <br/>
        <?php echo $disp_gazou;?>
        <br/>
        <br/>
        <form>
            <input type="button" onclick="history.back()" value="戻る">
        </form>

  </body>
</html>
