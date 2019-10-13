<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>アニメグッズ</title>
    </head>
    <body>


      <?php
          if(isset($_POST['change'])==true){
             $select=$_POST['select'];
              header('Location:shop_list.php?select='.$select);
       }
        catch(Exception $e){
        echo 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
        }


        if(isset($_POST['disp'])==true){
            if(isset($_POST['code'])==false){
              echo '商品が選択されていません。';
            }

            $code=$_POST['code'];
            header('Location:shop_disp.php?code='.$code);
            exit();
        }

  ?>



    </body>
</html>
