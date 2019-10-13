
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

          $opu_code=$post['code'];
          $opu_name=$post['name'];
          $opu_text=$post['text'];
          $opu_genre = $post['genre'];
          $opu_gazou_name_old=$_POST['gazou_name_old'];
          $opu_gazou=$_FILES['gazou'];
          $opu_txt1=$post['txt1'];
          $opu_txt2=$post['txt2'];
          $opu_txt3=$post['txt3'];
          $opu_txt4=$post['txt4'];
          $opu_pic1_name_old=$_POST['pic1_name_old'];
          $opu_pic2_name_old=$_POST['pic2_name_old'];
          $opu_pic3_name_old=$_POST['pic3_name_old'];
          $opu_pic4_name_old=$_POST['pic4_name_old'];
          $opu_pic1=$_FILES['pic1'];
          $opu_pic2=$_FILES['pic2'];
          $opu_pic3=$_FILES['pic3'];
          $opu_pic4=$_FILES['pic4'];


          if($opu_name == ''){
              echo '作品名が入力されていません。<br/>';
          }else{
              echo '作品名：';
              echo $opu_name;
              echo '<br/>';
              }

          if($opu_text == ''){
              echo '作品名が入力されていません。<br/>';
          }else{
              echo '作品名：';
              echo $opu_text;
              echo '<br/>';
              }

          if($opu_txt1 == ''){
              echo '作品説明1/4が入力されていません。<br/>';
          }else{
              echo '作品説明1/4：';
              echo $opu_txt1;
              echo '<br/>';
              }
          if($opu_txt2 == ''){
              echo '作品説明2/4が入力されていません。<br/>';
          }else{
              echo '作品説明2/4：';
              echo $opu_txt2;
              echo '<br/>';
              }
          if($opu_txt3 == ''){
              echo '作品説明3/4が入力されていません。<br/>';
          }else{
              echo '作品説明3/4：';
              echo $opu_txt3;
              echo '<br/>';
              }
          if($opu_txt4 == ''){
              echo '作品説明4/4が入力されていません。<br/>';
          }else{
              echo '作品説明4/4：';
              echo $opu_txt4;
              echo '<br/>';
              }



            if($opu_genre == ''){
                echo '商品ジャンルがされていません。<br/>';
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
          if($opu_pic1['size']>0){
            if($opu_pic1['size'] > 1000000){
                echo '画像が大き過ぎます。';
            }else{
                move_uploaded_file($opu_pic1['tmp_name'],'./gazou/'.$opu_pic1['name']);
                echo '<img src="./gazou/'.$opu_pic1['name'].'">';
                echo '<br/>';
            }
          }
          if($opu_pic2['size']>0){
            if($opu_pic2['size'] > 1000000){
                echo '画像が大き過ぎます。';
            }else{
                move_uploaded_file($opu_pic2['tmp_name'],'./gazou/'.$opu_pic2['name']);
                echo '<img src="./gazou/'.$opu_pic2['name'].'">';
                echo '<br/>';
            }
          }
          if($opu_pic3['size']>0){
            if($opu_pic3['size'] > 1000000){
                echo '画像が大き過ぎます。';
            }else{
                move_uploaded_file($opu_pic3['tmp_name'],'./gazou/'.$opu_pic3['name']);
                echo '<img src="./gazou/'.$opu_pic3['name'].'">';
                echo '<br/>';
            }
          }
          if($opu_pic4['size']>0){
            if($opu_pic4['size'] > 1000000){
                echo '画像が大き過ぎます。';
            }else{
                move_uploaded_file($opu_pic4['tmp_name'],'./gazou/'.$opu_pic4['name']);
                echo '<img src="./gazou/'.$opu_pic4['name'].'">';
                echo '<br/>';
            }
          }

          if($opu_name == '' || $opu_text == '' || $opu_txt1 == '' ||$opu_txt2 == '' ||$opu_txt3 == '' ||$opu_txt4 == '' || $opu_genre == '' || $pro_gazou['size']>1000000 || $opu_pic1['size']>1000000 || $opu_pic2['size']>1000000 || $opu_pic3['size']>1000000 || $opu_pic4['size']>1000000){
              echo '<form>';
              echo '<input type="button" onclick="history.back()" value="戻る">';
              echo '</form>';
          }else{
              echo '上記の様に変更します。<br/>';
              echo '<form method="post" action="opu_edit_done.php">';
              echo '<input type="hidden" name="code" value="'.$opu_code.'">';
              echo '<input type="hidden" name="name" value="'.$opu_name.'">';
              echo '<input type="hidden" name="text" value="'.$opu_text.'">';
              echo '<input type="hidden" name="txt1" value="'.$opu_txt1.'">';
              echo '<input type="hidden" name="txt2" value="'.$opu_txt2.'">';
              echo '<input type="hidden" name="txt3" value="'.$opu_txt3.'">';
              echo '<input type="hidden" name="txt4" value="'.$opu_txt4.'">';

              echo '<input type="hidden" name="genre" value="'.$opu_genre.'">';
              // 古い画像のままだったらその画像を表示
              echo '<input type="hidden" name="gazou_name_old" value="'.$opu_gazou_name_old.'">';
              // 新しい画像に代わっていたらこちらを表示
              echo '<input type="hidden" name="gazou_name" value="'.$opu_gazou['name'].'">';
              // ピクト変更
              echo '<input type="hidden" name="pic1_name_old" value="'.$opu_pic1_name_old.'">';
              echo '<input type="hidden" name="pic1_name" value="'.$opu_pic1['name'].'">';
              // ピクト2変更
              echo '<input type="hidden" name="pic2_name_old" value="'.$opu_pic2_name_old.'">';
              echo '<input type="hidden" name="pic2_name" value="'.$opu_pic2['name'].'">';
              // ピクト3変更
              echo '<input type="hidden" name="pic3_name_old" value="'.$opu_pic3_name_old.'">';
              echo '<input type="hidden" name="pic3_name" value="'.$opu_pic3['name'].'">';
              // ピクト4変更
              echo '<input type="hidden" name="pic4_name_old" value="'.$opu_pic4_name_old.'">';
              echo '<input type="hidden" name="pic4_name" value="'.$opu_pic4['name'].'">';


              echo '<br/>';
              echo '<input type="button" onclick="history.back()" value="戻る">';
              echo '<input type="submit" value="OK">';
              echo '</form>';
          }
        ?>
    </body>
</html>
