

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アニメグッズ</title>
    <link rel="stylesheet" type="text/css" href="../css/mypage.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  </head>
  <body>
    <!-- ヘッダー -->
   <header>
      <div class="container">
         <div class="header-left">
         <img class="logo" src="../img/logo.png" width="150" height="150" alt="ロゴ">
         </div>
       </div>
       <div class="header-right">
         <?php

         session_start();
         session_regenerate_id(true);
         if(isset($_SESSION['member_login'])==false){
           echo 'ようこそゲスト様　';
           echo '<a href="member_login.html">会員ログイン</a><br/>';
           echo '<a href="guest_add.html"><img src="../img/5.png" width="40" height="40" alt="会員登録"></a><br/>';
           echo '<br/>';
         }else{
           echo 'ようこそ';
           echo $_SESSION['member_name'];
           echo '様　';
           echo '<a href="member_logout.php"><img src="../img/7.png" width="40" height="40" alt="ログアウト" "></a>';
           echo '<a href="mypage.php"><img src="../img/1.png" width="40" height="40" alt="マイページ" "></a>';
           echo '<a href="shop_rirekilook.php"><img src="../img/8.png" width="40" height="40" alt="購入履歴" ></a>';
           echo '<a href="shop_cartlook.php"><img src="../img/2.png" width="40" height="40" alt="カート" ></a>';
           echo '<a href="shop_fabolook.php"><img src="../img/4.png" width="40" height="40" alt="お気に入り" ></a>';
           echo '<br/>';
         }
         // 　　検索バー
             if(isset($_GET['select'])==false){
               $select = '';
               // もし選択できなかったら何も表示しない
             }else{
               $select = $_GET['select'];
               // もし[select]が実行されている＝選択できていたら、それを変数$selectとして以下を実行する
             }

             try{
                 $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
                 $user = 'root';
                 $password = '';
                 $dbh = new PDO($dsn,$user,$password);
                 $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


                 if (isset($_GET['namesearch'])) {
                     $namesearch = $_GET['namesearch'];
                 } else {
                     $namesearch = '';
                 }

                 if($select=="感動"){
                   $sql = 'SELECT code,name,price FROM product WHERE genre="感動"';
                 }elseif($select=="異世界ファンタジー"){
                   $sql = 'SELECT code,name,price FROM product WHERE genre="異世界ファンタジー"';
                 }elseif($select=="バトルアクション"){
                   $sql = 'SELECT code,name,price FROM product WHERE genre="バトルアクション"';
                 }else{

                   $sql = 'SELECT code,name,price FROM product WHERE
                   name LIKE "%'.$namesearch.'%"';

                 }
                 $stmt = $dbh->prepare($sql);
                 $stmt->execute();
                 $dbh = null;
                 // 商品検索コード
                 echo '<form method="get">';
                 echo '<input type="text" placeholder="検索" name="namesearch" value="'.$namesearch.'">';
                 echo '<input type="image" src="../img/3.png" width="40" height="40" alt="検索ボタン">';
                 // echo '</div></div>';
                 echo '</form>';

                 echo '<br/>';
               }
                 catch(Exception $e){
                     echo 'ただいま障害により大変ご迷惑をお掛けしております。';
                     exit();
                 }
         ?>
       </div>
    </header>


    <?php

      $code=$_SESSION['member_code'];

      $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql = 'SELECT name,email,postal1,postal2,address,tel
              FROM dat_member WHERE code=?';
      $stmt = $dbh->prepare($sql);
      $data[] = $code;
      $stmt->execute($data);
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      $dbh = null;


      $onamae=$rec['name'];
      $email=$rec['email'];
      $postal1=$rec['postal1'];
      $postal2=$rec['postal2'];
      $address=$rec['address'];
      $tel=$rec['tel'];


      while(true){
          $rec = $stmt->fetch(PDO::FETCH_ASSOC);
          if($rec == false){
              break;
          }
          print '<input type="radio" name="addresscode" value="'.$rec['code'].'">';
          print $rec['postal1'];
          print '<br/>';
          print $rec['postal2'];
          print '<br/>';
          print $rec['address'];
          print '<br/>';

        }

?>



<div class="mypage-wrapper">
  <div class="item">
      <?php
      echo '氏名<br/>';
      echo $onamae;
      echo '<br/><br/>';
      ?>
  </div>
  <div class="item">
      <?php
      echo 'メールアドレス<br/>';
      echo $email;
      echo '<br/><br/>';
      ?>
  </div>
  <div class="item">
      <?php
      echo '郵便番号<br/>';
      echo $postal1;
      echo '-';
      echo $postal2;
      echo '<br/><br/>';
      ?>
  </div>
  <div class="item">
      <?php
      echo '住所<br/>';
      echo $address;
      echo '<br/><br/>';
      ?>
  </div>
  <div class="item">
      <?php
      echo '電話番号<br/>';
      echo $tel;
      echo '<br/><br/>';
     ?>
 </div>

</div>

    <?php

      echo '<form method="post" action="shop_kantan_done.php">';
      echo '<input type="hidden" name="onamae" value="'.$onamae.'">';
      echo '<input type="hidden" name="email" value="'.$email.'">';
      echo '<input type="hidden" name="postal1" value="'.$postal1.'">';
      echo '<input type="hidden" name="postal2" value="'.$postal2.'">';
      echo '<input type="hidden" name="address" value="'.$address.'">';
      echo '<input type="hidden" name="tel" value="'.$tel.'">';
      echo '<br/>';
      echo '<input type="button" onclick="history.back()" value="戻る">';
      echo '<input type="submit" value="OK"><br/>';
      echo '</form>';

    ?>





    <form>
        <div class="btn-wrapper">
          <a href="../shop/shop_list.php" class="btn home" style="text-decoration:none;" >戻る</a><br/><br/>
       </div>
    </form>



    <footer><p>© Copyright 2019 AnimeLabo All rights reserved.</p></footer>
   </body>
</html>
