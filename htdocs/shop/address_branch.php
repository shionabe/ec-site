<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false){
  echo 'ようこそゲスト様　';
  echo '<a href="member_login.html">会員ログイン</a><br/>';
  echo '<br/>';
}else{
  echo 'ようこそ';
  echo $_SESSION['member_name'];
  echo '様　';
  echo '<a href="member_logout.php">ログアウト</a><br/>';
  echo '<br/>';
}


if(isset($_POST['disp'])==true){

    if(isset($_POST['addresscode'])==false){
        header('Location:shop_address_ng.php');
      　exit();
    }

    $address_code=$_POST['addresscode'];
    header('Location:shop_kantan_check.php?addresscode='.$address_code);
    exit();
}

if(isset($_POST['add'])==true){
   header('Location:shop_address_add.php');
   exit();
}

// if(isset($_POST['edit'])==true){
//
//     if(isset($_POST['procode'])==false){
//         header('Location:pro_ng.php');
//         exit();
//     }
//     $pro_code=$_POST['procode'];
//         header('Location:pro_edit.php?procode='.$pro_code);
//         exit();
// }

?>
