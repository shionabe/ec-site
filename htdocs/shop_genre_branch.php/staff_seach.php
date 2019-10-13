<?php

session_start();
session_regenerate_id(true);
// ログインする

if(isset($_SESSION['login'])==false){
  echo 'ログインされていません。<br/>';
  echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
}else{
  echo $_SESSION['staff_name'];
  echo 'さんログイン中<br/>';
  echo '<br/>';
}

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>aaaa</title>
    </head>
    <body>

      <?php
      if(isset($_GET['select'])==false){
        $select = '';
        // もし選択できなかったら何も表示しない
        // 下の[SELECT]をもう一度、返している
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
          if (isset($_GET['codesearch'])) {
              $codesearch = $_GET['codesearch'];
          } else {
              $codesearch = '';
          }

          if($select==1){

            $sql = 'SELECT code,name FROM staff WHERE code=1';
            // 変数に1が代入されたらSQLの[staff]ファイルから[code][name]を呼び起こす
            // 以下同様
            // 1~3は完全一致検索、最後のelseの分岐だけは曖昧検索


          }elseif($select==2){

            $sql = 'SELECT code,name FROM staff WHERE code=2';

          }elseif($select==3){

            $sql = 'SELECT code,name FROM staff WHERE code=3';

          }else{

            $sql = 'SELECT code,name FROM staff WHERE code LIKE "%'.$codesearch.'%" AND name LIKE "%'.$namesearch.'%"';

          }

          $stmt = $dbh->prepare($sql);
          $stmt->execute();

          $dbh = null;

          echo '<form method="get">';
          echo '<input type="text" placeholder="No." class="codesearch" name="codesearch" value="'.$codesearch.'">';
          echo '<input type="text" placeholder="氏名" name="namesearch" value="'.$namesearch.'">';
          echo '<input type="submit" value="検索">';
          echo '</div></div>';
          echo '</form>';

          echo 'スタッフ一覧<br/><br/>';

          echo '<form method="post" action="staff_branch.php">';

          while(true){
              $rec = $stmt->fetch(PDO::FETCH_ASSOC);
              if($rec == false){
                  break;
              }
              echo '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
              echo $rec['name'];
              echo '<br/>';
          }
          echo '<input type="submit" name="disp" value="参照">';
          echo '<input type="submit" name="add" value="追加">';
          echo '<input type="submit" name="edit" value="修正">';
          echo '<input type="submit" name="delete" value="削除">';
          echo '<br/>';
          echo '<br/>';
          echo '<select name="select">';
          echo '<option value="">未選択</option>';
          echo '<option value="1">サンプル1</option>';
          echo '<option value="2">サンプル2</option>';
          echo '<option value="3">サンプル3</option>';
          echo '</select>';
          echo '<br/>';
          echo '<input type="submit" name="change" value="ジャンル変更">';
          echo '</form>';
      }

      catch(Exception $e){
          echo 'ただいま障害により大変ご迷惑をお掛けしております。';
          exit();
      }

      ?>
      <br/>
      <a href="../staff_login/staff_top.php">トップメニューへ</a><br/>

    </body>
</html>
