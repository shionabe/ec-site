
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>掲示板</title>
    </head>
      <body>
        <?php
        // $keiziban_code =$_GET['keizibancode'];

          require_once('../common/common.php');

          $post=sanitize($_POST);

          $keiziban_code=$post['keizibancode'];
          $keiziban_name = $post['name'];
          $keiziban_textile = $post['textile'];


          if($keiziban_name == ''){
              echo 'お名前が入力されていません。<br/>';
          }else{
              echo 'お名前：';
              echo $keiziban_name;
              echo '<br/>';
              }

          if($keiziban_textile == ''){
              echo '内容が入力されていません。<br/>';
          }else{
              echo '内容：';
              echo $keiziban_textile;
              echo '<br/>';
              }

          if($keiziban_name == '' || $keiziban_textile == '') {
              echo '<form>';
              echo '<input type="button" onclick="history.back()" value="戻る">';
              echo '</form>';
          }else{
              echo '上記の内容を追加します。<br/>';
              echo '<form method="post" action="keiziban_edit_done.php">';

              echo '<input type="hidden" name="name" value="'.$keiziban_name.'">';
              echo '<input type="hidden" name="textile" value="'.$keiziban_textile.'">';
              echo '<br/>';
              echo '<input type="button" onclick="history.back()" value="戻る">';
              echo '<input type="submit" value="OK">';
              echo '</form>';
            }
          ?>
    </body>
</html>
