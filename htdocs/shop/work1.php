

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アニメグッズ</title>
    <link rel="stylesheet" type="text/css" href="../css/work.css">
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
　<div class="work1-wrapper">

    <div class="work1-left">
      <div class="work1-YT">
          <div class="YT">
            <h2>What's Work？</h2>

            <iframe  width="100%" height="315" src="https://www.youtube.com/embed/Moe9wrOC5n4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
          <div class="YT-txt">
            <p>アフィブログ「超常科学キリキリバサラ」の管理人・我聞悠太はアフィブログで一攫千金を夢見る。面倒なことには首を突っ込まない小心者の彼があれよあれよと、事件に巻き込まれ…この伏線はここにつながっていたのか、最後までそれがわからない波乱の展開に目が離せない。</p>
          </div>
        </div>

      <div class="work1-PR">
        <h2>Recommend for you !!</h2>
        <?php
        try{
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT code,name,price,gazou FROM product WHERE
            name LIKE "%オカルティックナイン%"';

            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $dbh = null;

            echo '<br/>';
            echo '<form method="post" action="shop_genre_branch.php">';

            while(true){
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if($rec == false){
                    break;
                }
                echo '<a href="shop_product.php?procode='.$rec['code'].'">';
                echo $rec['name'].'---';
                echo '<br/>';

                echo
                '<img src="../product/gazou/'.$rec['gazou'].'">';
                echo '<br/>';

                // echo $rec['price'].'円';
                echo '<br/>';
                echo '<br/>';

            }

          }
          catch(Exception $e){
              echo 'ただいま障害により大変ご迷惑をお掛けしております。';
              exit();
          }



        ?>
      </div>
    </div>
    <div class="work1-right">
      <div class="work1-LP">
        <!-- ボディ左ここから -->
        <!-- セット1 -->
        <div class="item">
             <div class="item-box pic1">
               <img src="../opus/gazou/pic1.png" width="100%">
             </div>
        </div>
        <div class="item">
             <div class="item-box txt1">
               <p>ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ(168)</p>
             </div>
        </div>
        <!-- セット2 -->
        <div class="item">
             <div class="item-box txt2">

             </div>
        </div>
        <div class="item">
             <div class="item-box pic2">
               <img src="../opus/gazou/pic2.jpg" width="100%">
             </div>
        </div>
        <!-- セット3 -->
        <div class="item">
             <div class="item-box pic3">
               <img src="../opus/gazou/pic3.jpg" width="100%" >
             </div>
        </div>
        <div class="item">
             <div class="item-box txt3">
             </div>
        </div>
        <!-- セット4 -->
        <div class="item">
             <div class="item-box txt4">
             </div>
        </div>
        <div class="item">
             <div class="item-box pic4">
                <img src="../opus/gazou/pic4.jpg" width="100%" >
             </div>
        </div>
      <!-- ボディ左ここまで -->


      </div>
    </div>
  </div>


      <form>
          <div class="btn-wrapper">
            <a href="../shop/shop_list.php" class="btn home" style="text-decoration:none;" >戻る</a><br/><br/>
         </div>
      </form>


  <footer><p>© Copyright 2019 AnimeLabo All rights reserved.</p></footer>
</body>

</html>
