<!-- 以下のコードで、カートに入った商品を削除する -->


<?php
// セッション開始
session_start();
// $_SESSIONのデータを削除
$_SESSION=array();
// session_start();
// session_regenerate_id(true);
// $_SESSION['member_name']=$rec['name'];
// $_SESSION['member_login']=1;

// セッションクッキーの削除
if(isset($_SESSION[session_name()])==true){
  // もし変数[session_name()]に値が入っていたらtrueをだす
 // isset (引数=変数)変数1がセットされているときの処理;
  setcookie(session_name(),'',time()-42000,'/');
  // 一時的にデータを保存する・名前・データ・有効期限
  // この場合はカートという仮想空間に一時的にデータを保存する
}
session_destroy();
if(isset($_POST['clear'])==true){
   header('Location:shop_list.php');
   exit();
}

if(isset($_SESSION['member_login'])==false){
  echo 'ようこそゲスト様　';
  echo '<a href="member_login.html">会員ログイン</a><br/>';
  echo '<br/>';
}else{
  echo 'ようこそ';
  echo $_SESSION['member_name'];
  echo '様　';
  echo '<a href="member_logout.php">ログアウト</a><br/>';
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
    カートを空にしました。<br/>
    <input type="button" onclick="location.href='shop_cartlook.php'" value="戻る">
  </body>
</html>
