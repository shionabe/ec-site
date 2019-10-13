

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アニメグッズ</title>
    <link rel="stylesheet" type="text/css" href="../css/shop_product.css">
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

        try{
            $pro_code = $_GET['procode'];

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
                $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
              }
              echo '<br/>';
              echo '<br/>';
            }
            catch(Exception $e){
                echo 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

        ?>


        <!-- コンテンツ中身 ここから-->
        　<div class="item-wrapper">
               <section>
                 <div class="container">
                  　　<div class="item">
                       <div class="item-pic">
                         <?php echo $disp_gazou;?>
                         <br/>
                         <br/>
                       </div>
                      </div>
                      <div class="item-list">
                        <table >
                            <tr>
                            <th>My name</th>
                            <td><?php echo $pro_name;?></td>
                            </tr>
                            <tr>
                            <th>Price</th>
                            <td><?php echo $pro_price;?>+Tax</td>
                            </tr>
                            <div class="btn-wrapper">
                              <tr>
                              <th>
                              </th>
                              <td>
                                <?php echo '<a href="shop_faboin.php?procode='.$pro_code.'" class="btn fabo" style="text-decoration:none;" ><span class="fa fa-heart">
                                </span>お気に入りに追加</a><br/><br/>'?>
                                <?php echo '<a href="shop_cartin.php?procode='.$pro_code.'" class="btn cart" style="text-decoration:none;" ><span class="fa fa-cart-plus">
                              </span>カートに入れる</a><br/><br/>'?></td>
                              </tr>
                            </div>
                            </table>
                      </div>
                </div>
               </section>
        　</div>
        <!-- コンテンツ中身  ここまで-->


    　　 <form>
            <div class="btn-wrapper">
              <a href="../shop/shop_list.php" class="btn back" style="text-decoration:none;" >戻る</a><br/><br/>
           </div>
        </form>


    <footer><p>© Copyright 2019 AnimeLabo All rights reserved.</p></footer>
   </body>
</html>
