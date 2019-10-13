<?php
  session_start();
  session_regenerate_id(true);
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
      require_once('../common/common.php');

      $post = sanitize($_POST);

      $onamae = $post['onamae'];
      $email = $post['email'];
      $postal1 = $post['postal1'];
      $postal2 = $post['postal2'];
      $address = $post['address'];
      $tel = $post['tel'];
      $chumon = $post['chumon'];
      $pass = $post['pass'];
      $danjo = $post['danjo'];

      echo $onamae.'様<br/>';
      echo 'ご注文ありがとうございました。<br/>';
      echo $email.'にメールをお送りいたしましたのでご確認ください。<br/>';
      echo '商品は下記の住所に発送させていただきます。<br/>';
      echo $postal1.'-'.$postal2.'<br/>';
      echo $address.'<br/>';
      echo $tel.'<br/>';
      echo '<br/>';

      $honbun='';
      $honbun.=$onamae."様\n\nこの度はご注文ありがとうございました。\n";
      $honbun.="\n";
      $honbun.="ご注文商品一覧\n";
      $honbun.="-----------------------------------\n";

      $cart=$_SESSION['cart'];
      $kazu=$_SESSION['kazu'];
      $max=count($cart);

      $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      for($i=0;$i<$max;$i++){
        $sql='SELECT name,price FROM product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[0]=$cart[$i];
        $stmt->execute($data);

        $rec=$stmt->fetch(PDO::FETCH_ASSOC);

        $name=$rec['name'];
        $price=$rec['price'];
        $kakaku[]=$price;
        $suryo=$kazu[$i];
        $shokei=$price * $suryo;

        $honbun.=$name.'';
        $honbun.=$price.'円x';
        $honbun.=$suryo.'個=';
        $honbun.=$shokei."円\n";
      }

      $sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();

      $lastmembercode=0;
      if($chumon=='chumontouroku'){
        $sql='INSERT INTO dat_member(password,name,email,postal1,postal2,address,tel,danjo)
        VALUES(?,?,?,?,?,?,?,?)';
        $stmt=$dbh->prepare($sql);
        $data=array();
        $data[]=md5($pass);
        $data[]=$onamae;
        $data[]=$email;
        $data[]=$postal1;
        $data[]=$postal2;
        $data[]=$address;
        $data[]=$tel;
        if($danjo=='dan'){
          $data[]=1;
        }else{
          $data[]=2;
        }
        $stmt->execute($data);

        $sql='SELECT LAST_INSERT_ID()';
        $stmt=$dbh->prepare($sql);
        $stmt->execute();
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $lastmembercode=$rec['LAST_INSERT_ID()'];
      }

      $sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
      $stmt=$dbh->prepare($sql);
      $data=array();
      $data[]=$lastmembercode;
      $data[]=$onamae;
      $data[]=$email;
      $data[]=$postal1;
      $data[]=$postal2;
      $data[]=$address;
      $data[]=$tel;
      $stmt->execute($data);

      $sql='SELECT LAST_INSERT_ID()';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();
      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      $lastcode=$rec['LAST_INSERT_ID()'];

      for($i=0;$i<$max;$i++){
        $sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
        $stmt=$dbh->prepare($sql);
        $data=array();
        $data[]=$lastcode;
        $data[]=$cart[$i];
        $data[]=$kakaku[$i];
        $data[]=$kazu[$i];
        $stmt->execute($data);
      }

      $sql='UNLOCK TABLES';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();

      $dbh=null;

      if($chumon=='chumontouroku'){
        echo '会員登録が完了いたしました。<br/>';
        echo '次回からメールアドレスとパスワードでログインしてください。<br/>';
        echo 'スムーズにご注文することができます。<br/>';
        echo '<br/>';
      }

      $honbun.="送料は無料です。\n";
      $honbun.="-----------------------------------\n";
      $honbun.="\n";
      $honbun.="代金は下記の口座にお振り込みください。\n";
      $honbun.="oo銀行 xx支店 普通口座 1234567\n";
      $honbun.="入金の確認が取れ次第、発送させて頂きます。\n";
      $honbun.="\n";

      if($chumon=='chumontouroku'){
        $honbun.="会員登録が完了いたしました。\n";
        $honbun.="次回からメールアドレスとパスワードでログインしてください。\n";
        $honbun.="スムーズにご注文することができます。\n";
        $honbun.="\n";
      }

      $honbun.="-----------------------------------\n";
      $honbun.="　　〜やまもと楽器〜\n";
      $honbun.="　oo県xx市△△町12-34\n";
      $honbun.="　TEL:090-xxxx-xxxx\n";
      $honbun.="　MAIL:info@yamamotogakki.co.jp\n";
      $honbun.="-----------------------------------\n";

      // 本文確認用
      // echo nl2br($honbun);

      // お客様へメール送信
      $title='ご注文完了致しました';
      $header='From:info@info@yamamotogakki.co.jp';
      $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
      mb_language('Japanese');
      mb_internal_encoding('UTF-8');
      mb_send_mail($email,$title,$honbun,$header);

      // 注文確認用メール
      $title='注文がありました';
      $header='From:'.$email;
      $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
      mb_language('Japanese');
      mb_internal_encoding('UTF-8');
      mb_send_mail('info@info@yamamotogakki.co.jp',$title,$honbun,$header);

    }catch(Exception $e){
      echo 'ただいま障害により大変ご迷惑をおかけしております。';
      exit();
    }

    ?>
    <form method="post" action="clear_cart.php">
      <input type="submit" name="clear" value="商品画面へ">
    </form>

  </body>
</html>
