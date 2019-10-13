

<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>アニメグッズ</title>
    </head>
    <body>
      商品追加<br/>
      <br/>
      <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
        商品名を入力してください。<br/>
        <input type="text" name="name" style="width:200px"><br/>
        価格を入力してください。<br/>
        <input type="text" name="price" style="width:50px"><br/>
        画像を選んでください。<br/>
        <input type="file" name="gazou" style="width:400px"><br/>
        商品のジャンルを選んでください。<br/>
        <select name="genre">
          <option value="未選択">選択してください</option>
          <option value="感動">感動</option>
          <option value="異世界ファンタジー">異世界ファンタジー</option>
          <option value="バトルアクション">バトルアクション</option>
        </select>

        <br/>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
      </form>
    </body>
</html>
