<?php

        try{

            $code=$_SESSION['member_code'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);



            $sql = 'SELECT code,postal1,postal2,address
                    FROM dat_member WHERE code=?';

            $stmt = $dbh->prepare($sql);
            // $date[]=$_SESSION['member_code'];
            $date[]=$code;
            $stmt->execute($data);
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);




            $dbh = null;

            $code=$rec['code'];
            $postal1=$rec['postal1'];
            $postal2=$rec['postal2'];
            $address=$rec['address'];



          // if (isset($_SESSION['member_login'])==false){
          //   echo '';
          // }else{
            //   print '<form method="post" action="address_branch.php">';
            //     print '<input type="radio" name="addresscode" value="'.$rec['code'].'">';
            //     print '郵便番号：';
            //     // print $rec['postal1'];
            //     echo $postal1;
            //     print '-';
            //     print $rec['postal2'];
            //     print '住所：';
            //     print $rec['address'];
            //     print '<br/>';
            // print '<input type="submit" name="disp" value="登録した住所に送る" action="">';
            // print '<input type="submit" name="add" value="新しい住所を登録する" action="">';
            // print '</form>';

      }

        catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }

     print '<form method="post" action="address_branch.php">';
          print '<input type="radio" name="addresscode" value="'.$rec['code'].'">';
          print '郵便番号：';
          echo $_SESSION['member_code'];
          // print $rec['postal1'];
          echo $postal1;
          print '-';
          print $rec['postal2'];
          print '住所：';
          print $rec['address'];
          print '<br/>';
      print '<input type="submit" name="disp" value="登録した住所に送る" action="">';
      print '<input type="submit" name="add" value="新しい住所を登録する" action="">';
      print '</form>';

        ?>
