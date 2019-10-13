

<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>アニメグッズ</title>
    </head>
      <body>
        <?php

          require_once('../common/common.php');

          $post=sanitize($_POST);

          $opu_name=$post['name'];
          $opu_text=$post['text'];
          $opu_genre=$post['genre'];
          $opu_gazou=$_FILES['gazou'];
          $opu_txt1=$post['txt1'];
          $opu_txt2=$post['txt2'];
          $opu_txt3=$post['txt3'];
          $opu_txt4=$post['txt4'];
          $opu_pic1=$_FILES['pic1'];
          $opu_pic2=$_FILES['pic2'];
          $opu_pic3=$_FILES['pic3'];
          $opu_pic4=$_FILES['pic4'];

          if($opu_name == ''){
              echo '商品名が入力されていません。<br/>';
          }else{
              echo '商品名：';
              echo $opu_name;
              echo '<br/>';
              }


          if($opu_text == ''){
              echo '商品説明が入力されていません。<br/>';
          }else{
              echo '商品説明：';
              echo $opu_text;
              echo '<br/>';
              }

          if($opu_txt1 == '' || $opu_txt2 == '' ||$opu_txt3 == '' ||$opu_txt4 == ''){
              echo '商品説明が入力されていません。<br/>';
          }else{
              echo '商品説明1/4：';
              echo $opu_txt1;
              echo '<br/>';
              echo '商品説明2/4：';
              echo $opu_txt2;
              echo '<br/>';
              echo '商品説明3/4：';
              echo $opu_txt3;
              echo '<br/>';
              echo '商品説明4/4：';
              echo $opu_txt4;
              echo '<br/>';
              }

            if($opu_genre == "未選択"){
                echo 'ジャンルが選択されていません。<br/>';
            }else{
                echo 'ジャンル：';
                echo $opu_genre;
                echo '<br/>';
                }

            if($opu_gazou['size']>0){
              if($opu_gazou['size'] > 1000000){
                  echo '画像が大き過ぎます。';
              }else{
                  move_uploaded_file($opu_gazou['tmp_name'],'./gazou/'.$opu_gazou['name']);
                  echo '<img src="./gazou/'.$opu_gazou['name'].'">';
                  echo '<br/>';
              }
            }

          



          if($opu_name == '' || $opu_text == '' || $opu_genre == "未選択" ||$opu_txt1 == '' || $opu_txt2 == '' ||$opu_txt3 == '' ||$opu_txt4 ||$opu_gazou['size'] > 1000000 ){
              echo '<form>';
              echo '<input type="button" onclick="history.back()" value="戻る">';
              echo '</form>';
          }else{
              echo '上記の商品を追加します。<br/>';
              echo '<form method="post" action="opu_add_done.php">';
              echo '<input type="hidden" name="name" value="'.$opu_name.'">';
              echo '<input type="hidden" name="text" value="'.$opu_text.'">';
              echo '<input type="hidden" name="genre" value="'.$opu_genre.'">';
              echo '<input type="hidden" name="gazou_name" value="'.$opu_gazou['name'].'">';
              echo '<br/>';
              echo '<br/>';
              echo '<input type="hidden" name="txt1" value="'.$opu_txt1.'">';
              echo '<input type="hidden" name="txt2" value="'.$opu_txt2.'">';
              echo '<input type="hidden" name="txt3" value="'.$opu_txt3.'">';
              echo '<input type="hidden" name="txt4" value="'.$opu_txt4.'">';
              echo '<br/>';
              echo '<br/>';
              echo '<input type="hidden" name="pic1_name" value="'.$opu_pic1['name'].'">';
              echo '<input type="hidden" name="pic2_name" value="'.$opu_pic2['name'].'">';
              echo '<input type="hidden" name="pic3_name" value="'.$opu_pic3['name'].'">';
              echo '<input type="hidden" name="pic4_name" value="'.$opu_pic4['name'].'">';


              echo '<br/>';
              echo '<input type="button" onclick="history.back()" value="戻る">';
              echo '<input type="submit" value="OK">';
              echo '</form>';
          }
        ?>
    </body>
</html>
