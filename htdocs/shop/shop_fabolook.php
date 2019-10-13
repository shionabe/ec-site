<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false){
  echo 'ようこそゲスト様　';
  echo '<a href="member_login.html">会員ログイン</a><br/>';
  echo '<br/>';
}else{
  echo 'ようこそ';
  echo $_SESSION['member_name'];
  echo '様　';
  echo '<a href="member_logout.php">ログアウト</a><br/>';
  echo '<a href="shop_rirekilook.php">購入履歴を見る</a><br/>';
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

            if(isset($_SESSION['fabo'])==true){

              // cartに[1]が入っていればtrueを実行する
              $fabo=$_SESSION['fabo'];
              $kazu=$_SESSION['kazu'];
              $max=count($fabo);
            }else{
              $max=0;
            }

            if($max==0){
              // PHPの時は代入するためにイコールは２つつける
              // 意味：もしcartの中身がゼロだったら以下を表示して
              echo 'お気に入り登録された商品がありません。';
              echo '<br/>';
              echo '<a href="shop_list.php">商品一覧へ戻る</a>';
              exit();
            }
            // 意味：elseは書いていないけどもしcartに商品が入っていたら以下を実行
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            foreach($fabo as $key=> $val){
              $sql='SELECT code,name,price,gazou
              FROM product WHERE code=?';

              $stmt=$dbh->prepare($sql);
              $data[0]=$val;
              $stmt->execute($data);

              $rec=$stmt->fetch(PDO::FETCH_ASSOC);

              $pro_name[]=$rec['name'];
              $pro_price[]=$rec['price'];

              if($rec['gazou']==''){
                $pro_gazou[]='';
              }else{
                $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
              }
            }

           $code=$_SESSION['member_code'];

            $sql = 'SELECT code,postal1,postal2,address
                    FROM dat_member WHERE code=?';

            $stmt = $dbh->prepare($sql);
            $date[]=$_SESSION['member_code'];
            // $date[]=$code;
            $stmt->execute($data);
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $dbh = null;

            $code=$rec['code'];
            $postal1=$rec['postal1'];
            $postal2=$rec['postal2'];
            $address=$rec['address'];

            // $dbh = null;


            }
            catch(Exception $e){
                echo 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

        ?>

        お気に入りされた商品<br/>
        <br/>
        <form method="post" action="kazu_change.php">
        <table border="1">
        <tr>
          <td>商品</td>
          <td>商品画像</td>
          <td>価格</td>
          <td>数量</td>
          <td>小計</td>
          <td>削除</td>
        </tr>
        <?php for($i=0;$i<$max;$i++){ ?>
        <tr>
          <td><?php echo $pro_name[$i]; ?></td>
          <td><?php echo $pro_gazou[$i]; ?></td>
          <td><?php echo $pro_price[$i]; ?>円</td>
          <td><input type="text" name="kazu<?php echo $i; ?>" value="<?php echo $kazu[$i]; ?>"></td>
          <td><?php echo $pro_price[$i] * $kazu[$i]; ?>円</td>
          <td><input type="checkbox" name="sakujo<?php echo $i; ?>"></td>
        </tr>
        <?php } ?>
        </table>
            <input type="hidden" name="max" value="<?php echo $max; ?>">
            （削除する際は、削除にチェックを入れて数量変更ボタンを押してください。）<br/>
            <br/>
            <input type="button" onclick="location.href='clear_fabo.php'" value="お気に入りを削除する"><br/>
            <input type="button" onclick="location.href='shop_list.php'" value="戻る">
        </form>
        <input type="button" onclick="location.href='shop_form.html'" value="ご購入手続きへ進む"><br/>
        <!-- <a href="shop_form.html">ご購入手続きへ進む</a> -->
        <br/>



      <form method="post" action="address_branch.php">
      <input type="radio" name="addresscode" value="<?php $rec['code']?>">

      <?php

          echo '郵便番号：';
          // echo $_SESSION['member_code'];
          // print $rec['postal1'];
          echo $postal1;
          echo '-';
          echo $rec['postal2'];
          echo '住所：';
          echo $rec['address'];
          echo '<br/>';

          ?>

    <input type="submit" name="disp" value="登録した住所に送る" action="">
    <input type="submit" name="add" value="新しい住所を登録する" action="">
   </form>


  </body>
</html>
