<!-- 以下のコードで、カートに入った商品を削除する -->

<?php
// セッション開始
session_start();
// セッションの値を初期化
$_SESSION=array();
// isset＝変数が存在するかを確認する

if(isset($_COOKIE[session_name()])==true){
  // もし変数[session_name()]に値が入っていたらtrueをだす
 // isset (引数=変数)変数1がセットされているときの処理;
  setcookie(session_name(),'',time()-42000,'/');
  // 一時的にデータを保存する・名前・データ・有効期限
  // この場合はカートという仮想空間に一時的にデータを保存する
}
// 変数1がセットされていないときの処理
// セッションを破棄
session_destroy();

if(isset($_POST['clear'])==true){
   header('Location:shop_list.php');
   exit();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>アニメグッズ</title>
  </head>
  <body>
    お気に入りを削除しました。<br/>
    <input type="button" onclick="location.href='shop_fabolook.php'" value="戻る">
  </body>
</html>
