<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>アニメグッズ</title>
  </head>
  <body>
        <?php

        try{
            $opu_code = $_GET['opuscode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name,text,genre,gazou,txt1,txt2,txt3,txt4,pic1,pic2,pic3,pic4 FROM work WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $opu_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $opu_name = $rec['name'];
            $opu_text = $rec['text'];
            $opu_genre = $rec['genre'];
            $opu_gazou_name_old = $rec['gazou'];
            $opu_txt1=$rec['txt1'];
            $opu_txt2=$rec['txt2'];
            $opu_txt3=$rec['txt3'];
            $opu_txt4=$rec['txt4'];
            $opu_pic1_name_old=$rec['pic1'];
            $opu_pic2_name_old=$rec['pic2'];
            $opu_pic3_name_old=$rec['pic3'];
            $opu_pic4_name_old=$rec['pic4'];



            $dbh = null;
            // 画像が更新されていたら新しい名前をいれてね
              if($opu_gazou_name_old==''){
                $disp_gazou='';
              }else{
                // 画像が更新されていなければ古い画像のまま
                $disp_gazou='<img src="./gazou/'.$opu_gazou_name_old.'">';
              }



            }
            catch(Exception $e){
                echo 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

        ?>
        作品情報修正<br/>
        <br/>
        作品コード<br/>
        <?php echo $opu_code; ?>
        <br/>
        <br/>
        <form method ="post" action="opu_edit_check.php" enctype="multipart/form-data">
            <input type="hidden" name="code" value="<?php echo $opu_code;?>">
            <input type="hidden" name="gazou_name_old" value="<?php echo $opu_gazou_name_old;?>">
            作品名<br/>
            <input type="text" name="name" style="width:200px" value="<?php echo $opu_name; ?>">
            <br/>
            作品紹介<br/>
            <input type="text" name="text" style="width:200px" value="<?php echo $opu_text; ?>">
            <br/>
            作品ジャンル<br/>

              <select name="genre" >
              <option value="">未選択</option>
              <option value="1~3">冬アニメ</option>
              <option value="4~6">春アニメ</option>
              <option value="7~9">夏アニメ</option>
              <option value="10~12">秋アニメ</option>
              </select>


            <br/>
            <?php echo $disp_gazou; ?>
            <br/>
            画像を選んでください。<br/>
            <input type="file" name="gazou" style="width:400px"><br/>
            <br/>

            <br/>
            <br/>
            <input type="text" name="txt1" style="width:200px"><br/>
            作品紹介1/4を140字以内で入力してください。<br/>
            <br/>
            <input type="text" name="txt2" style="width:200px"><br/>
            作品紹介2/4を140字以内で入力してください。<br/>
            <br/>
            <input type="text" name="txt3" style="width:200px"><br/>
            作品紹介3/4を140字以内で入力してください。<br/>
            <br/>
            <input type="text" name="txt4" style="width:200px"><br/>
            作品紹介4/4を140字以内で入力してください。<br/>
            <br/>
            <br/>
            <!-- 画像 -->
            作品紹介1/4に使用する画像を選んでください。<br/>
            <input type="file" name="pic1" style="width:400px"><br/>
            <br/>
            作品紹介2/4に使用する画像を選んでください。<br/>
            <input type="file" name="pic2" style="width:400px"><br/>
            <br/>
            作品紹介3/4に使用する画像を選んでください。<br/>
            <input type="file" name="pic3" style="width:400px"><br/>
            <br/>
            作品紹介4/4に使用する画像を選んでください。<br/>
            <input type="file" name="pic4" style="width:400px"><br/>
            <br/>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
  </body>
</html>
