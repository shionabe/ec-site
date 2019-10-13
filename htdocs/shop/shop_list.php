

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アニメグッズ</title>
    <link rel="stylesheet" type="text/css" href="../css/shop_list.css">
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
<!-- ヘッダーここまで -->

<!-- コンテンツ中身 ここから-->

<!-- AD -->
<div class="top-wrapper">

  <div class="item">
    <div class="item-box green">
    </div>
  </div>
  <div class="item">
    <div class="item-box yellow">
    </div>
  </div>
  <div class="item">
    <div class="item-box red">
    </div>
  </div>
  <div class="item">
    <div class="item-box blue">
    </div>
  </div>

</div>

<!-- 作品一覧 -->
<div class="work-wrapper">
</br>
</br>
</br>
</br>
</br>
  <h2>Recomend works!! </h2>
  <!-- 作品1 -->
  <div class="work" >
    <div class="work-icon">
      <a href="./work1.php"><img src="../opus/gazou/work1.png" height="150px" width="150px"></a>
      <p>作品名</p>
    </div>
    <div class="txt-contents">
      ああああああああああああああああ
    </div>
  </div>
  <!-- 作品2 -->
  <div class="work" >
    <div class="work-icon">
      <a href="./work2.php"><img src="../opus/gazou/work2.png" height="150px" width="150px"></a>
      <p>作品名</p>
    </div>
    <div class="txt-contents">
      ああああああああああああああああ
    </div>
  </div>
  <!-- 作品3 -->
  <div class="work" >
    <div class="work-icon">
      <a href="./work3.php"><img src="../opus/gazou/work3.png" height="150px" width="150px"></a>
      <p>作品名</p>
    </div>
    <div class="txt-contents">
      ああああああああああああああああ
    </div>
  </div>
  <!-- 作品4 -->
  <div class="work" >
    <div class="work-icon">
      <a href="./work4.php"><img src="../opus/gazou/work4.png" height="150px" width="150px"></a>
      <p>作品名</p>
    </div>
    <div class="txt-contents">
      ああああああああああああああああ
    </div>
  </div>



</div>


<?php

try{
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name,price,gazou FROM product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

  // 商品一覧コード
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<br/>';
    echo '<h2>商品一覧</h2>';
    echo '<form method="post" action="shop_genre_branch.php">';
    while(true){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == false){
            break;
        }
        echo '<a href="shop_product.php?procode='.$rec['code'].'">';
        echo $rec['name'].'---';
        echo $rec['price'].'円';
        echo '<br/>';
        echo '<img src="../product/gazou/'.$rec['gazou'].'">';
        echo '</a>';
        echo '<br/>';
    }
  }
catch(Exception $e){
    echo 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
 }


?>


<?php
          // 商品ジャンルコード
          echo '<h2>商品ジャンル</h2>';
          // echo '<a href="genre_kando.php">感動</a><br/>';
          echo '<form method="post" action="shop_genre_branch.php">';
          echo '<select name="select" >';
          echo '<option value="">未選択</option>';
          echo '<option value="感動">感動</option>';
          echo '<option value="異世界ファンタジー">異世界ファンタジー</option>';
          echo '<option value="バトルアクション">バトルアクション</option>';
          echo '</select>';
          echo '<input type="submit" name="change" value="ジャンル変更">';
          echo '</form>';
          echo '<br/>';




      ?>
      <form>
          <div class="btn-wrapper">
            <a href="#" class="btn home" style="text-decoration:none;" ><span class="fa fa-home">
            </span>ホームへ</a><br/><br/>
         </div>
      </form>

    <footer></footer>
  </body>
</html>
