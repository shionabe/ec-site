

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アニメグッズ</title>
    <link rel="stylesheet" type="text/css" href="../css/shop_cartlook.css">
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




<!-- コンテンツの中身ここから -->


    <?php

        try{

            if(isset($_SESSION['cart'])==true){

              // cartに[1]が入っていればtrueを実行する
              $cart=$_SESSION['cart'];
              $kazu=$_SESSION['kazu'];
              $max=count($cart);
            }else{
              $max=0;
            }

            if($max==0){
              // PHPの時は代入するためにイコールは２つつける
              // 意味：もしcartの中身がゼロだったら以下を表示して
              echo '<br/>';
              echo '<br/>';
              echo '<br/>';
              echo '<br/>';
              echo '<br/>';
              echo '<br/>';
              echo '<br/>';
              echo 'カートに商品が入っていません。';
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

            foreach($cart as $key=> $val){
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

           // $code=$_SESSION['member_code'];

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



  <!-- コンテンツ中身 ここから-->
      <br/>
      <form method="post" action="kazu_change.php">

        　<div class="item-wrapper">
               <section>
                 <div class="container">
                  　　<div class="item">
                        <div class="item-list">
                          <table>
                              <h2>Your cart in XXXX.</h2>
                          <tr>
                            <th width="20%"></th>
                            <th width="20%"></th>
                            <th width="10%"></th>
                            <th width="30%"></th>
                          </tr>
                          <?php for($i=0;$i<$max;$i++){ ?>
                          <tr>
                            <td  width="20%"><?php echo $pro_gazou[$i]; ?></td>
                            <td  width="20%"><?php echo $pro_name[$i]; ?><?php echo $pro_price[$i]; ?>円</td>
                            <td  width="20%">
                              <input type="text" name="kazu<?php echo $i; ?>" value="<?php echo $kazu[$i]; ?>">
                             <input type="submit" value="数量変更">
                             <br/>
                              <input type="checkbox" name="sakujo<?php echo $i; ?>">
                              <input type="submit" value="削除">
                              <input type="hidden" name="max" value="<?php echo $max; ?>">
                              <br/>
                              <br/>
                             </td>
                              <br/>
                              <br/>
                              <td  width="10%">小計 <?php echo $pro_price[$i] * $kazu[$i]; ?>円
                                <br/>
                                <br/>
                              </td>
                              <br/>
                           </tr>
                          <?php } ?>
                          </table>
                        </div>

              <div class="order-wrapper">
                <br/>
                <br/>
                <div class="container">
                  <div class="order">
                     <div class="order-left">
                       <a href="clear_cart.php" class="btn back" style="text-decoration:none;" ><span class="fa fa-undo">
                       </span>カートを空にする</a><br/>
                    </div>
                  </div>

                  <div class="order">
                     <div class="order-right">
                       <a href="shop_form.html" class="btn barcode" style="text-decoration:none;" ><span class="fa fa-barcode">
                       </span>ご購入手続きへ進む</a><br/>
                             <form method="post" action="address_branch.php">
                             <input type="radio" name="addresscode" value="<?php $rec['code']?>">
                             <?php
                                 echo '郵便番号：';
                                 echo $rec['postal1'];
                                 echo '-';
                                 echo $rec['postal2'];
                                 echo '住所：';
                                 echo $rec['address'];
                                 echo '<br/>';
                             ?>
                           <input type="submit" name="disp" value="登録した住所に送る" action="">
                           <input type="submit" name="add" value="新しい住所を登録する" action="">
                          </form>
                    </div>
                  </div>


                </div>
              </div>
                         <br/>
                       </div>
                      </div>
                </div>
               </section>
        　</div>
        <!-- コンテンツ中身  ここまで-->









        </form>

        <!-- <a href="shop_form.html">ご購入手続きへ進む</a> -->
        <br/>


　　 <form>
       <div class="btn-wrapper">
         <a href="../shop/shop_list.php" class="btn back" style="text-decoration:none;" >戻る</a><br/><br/>
      </div>
   </form>

   <!-- コンテンツの中身ここまで-->


  </body>
</html>
