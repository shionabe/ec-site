

<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>アニメグッズ</title>
    </head>
    <body>
      作品追加<br/>
      <br/>
      <form method="post" action="opu_add_check.php" enctype="multipart/form-data">
        作品名を入力してください。<br/>
        <input type="text" name="name" style="width:200px"><br/>
        作品紹介を140字以内で入力してください。<br/>
        <input type="text" name="text" style="width:200px" style="height:100px"><br/>
        画像を選んでください。<br/>
        <input type="file" name="gazou" style="width:400px"><br/>
        商品のジャンルを選んでください。<br/>
        <select name="genre">
          <option value="未選択">選択してください</option>
          <option value="1~3">冬アニメ</option>
          <option value="4~6">春アニメ</option>
          <option value="7~9">夏アニメ</option>
          <option value="10~12">秋アニメ</option>
        </select>
  <!-- work?.phpシートのwork?-LPに書くテキストと画像 -->
        <!-- テキスト -->
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
<!-- ホームボタン -->
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
      </form>
    </body>
</html>
