<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>アニメグッズ</title>
  </head>
  <body>

    <?php

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
    $pass2 = $post['pass2'];
    $danjo = $post['danjo'];

    $okflg = true;

    if($chumon=='chumondouishinai'){
      echo "同意してね";
      echo '<br/>';
      echo '<input type="button" onclick="history.back()" value="戻る">';
      // $okflg = false;
      exit();
    }

    if($onamae==''){
      echo 'お名前が入力されていません。<br/><br/>';
      $okflg = false;
    }else{
      echo '氏名：';
      echo $onamae;
      echo '<br/>';
    }

    if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email)==0){
      echo 'メールアドレスを正しく入力してください。<br/><br/>';
      $okflg = false;
    }else{
      echo 'メールアドレス：';
      echo $email;
      echo '<br/>';
    }

    if(preg_match('/\A[0-9]+\z/',$postal1)==0){
      echo '郵便番号は半角数字で入力してください。<br/><br/>';
      $okflg = false;
    }elseif(preg_match('/\A[0-9]+\z/',$postal2)==0){
      echo '郵便番号は半角数字で入力してください。<br/><br/>';
      $okflg = false;
    }else{
      echo '郵便番号：〒';
      echo $postal1.'-'.$postal2;
      echo '<br/>';
    }

    if(preg_match('/\A[0-9]+\z/',$postal2)==0){
      echo '郵便番号は半角数字で入力してください。<br/><br/>';
    }

    if($address==''){
      echo '住所が入力されていません。<br/><br/>';
      $okflg = false;
    }else{
      echo '住所：';
      echo $address;
      echo '<br/>';
    }

    if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$tel)==0){
      echo '電話番号は半角数字とハイフンで入力してください。<br/><br/>';
      $okflg = false;
    }else{
      echo '電話番号：';
      echo $tel;
      echo '<br/>';
    }
    //
    // if($chumon=='chumondoui'){
    //   if($pass==''){
    //     echo 'パスワードが入力されていません。<br/><br/>';
    //     $okflg=false;
    //   }
    // if($pass && $pass2 ==''){
    //   echo 'パスワードを入力してください。<br/><br/>';
    //   $okflg=false;
    // }


      if($pass!=$pass2){
        echo 'パスワードが一致しません。<br/><br/>';
        $okflg=false;
      }

      echo '性別<br/>';

      if($danjo=='dan'){
        echo '男性';
      }else{
        echo '女性';
      }

      echo '<br/><br/>';



    if($okflg == true){
      echo '<form method="post" action="guest_add_done.php">';
      echo '<input type="hidden" name="onamae" value="'.$onamae.'">';
      echo '<input type="hidden" name="email" value="'.$email.'">';
      echo '<input type="hidden" name="postal1" value="'.$postal1.'">';
      echo '<input type="hidden" name="postal2" value="'.$postal2.'">';
      echo '<input type="hidden" name="address" value="'.$address.'">';
      echo '<input type="hidden" name="tel" value="'.$tel.'">';
      echo '<input type="hidden" name="chumon" value="'.$chumon.'">';
      echo '<input type="hidden" name="pass" value="'.$pass.'">';
      echo '<input type="hidden" name="danjo" value="'.$danjo.'">';
      echo '<br/>';
      echo '上記でお間違いないですか？<br/>';
      echo '<input type="button" onclick="history.back()" value="戻る">';
      echo '<input type="submit" value="OK"><br/>';
      echo '</form>';
    }else{
      echo '<form>';
      echo '<input type="button" onclick="history.back()" value="戻る">';
      echo '</form>';
    }

    ?>

  </body>
</html>
