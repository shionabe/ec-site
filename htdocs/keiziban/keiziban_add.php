
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>掲示板</title>
    </head>
    <body>
      <p>何をつぶやく？</p>
      <form method="post" action="keiziban_add_check.php" enctype="multipart/form-data" >
        お名前<br/>
        <input type="text" name="name" style="width:200px"><br/>
        もの申したいこと<br/>
        <input type="text" name="textile" style="width:200px"><br/>
        <input type="submit" value="OK">
        <br/>
      </form>
    </body>
</html>
