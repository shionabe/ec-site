<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
  echo 'ログインされていません。<br/>';
  echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
}

if(isset($_POST['change'])==true){
   $select=$_POST['select'];
    header('Location:staff_list.php?select='.$select);
    exit();
// [staff/staff_seach.php]のジャンル選択の[select]nameとしているので、変更が会った時は
// 　[staff_list.php?select='.$select]を表示
}

if(isset($_POST['disp'])==true){

    if(isset($_POST['staffcode'])==false){
        header('Location:staff_ng.php');
      　exit();
    }

    $staff_code=$_POST['staffcode'];
    header('Location:staff_disp.php?staffcode='.$staff_code);
    exit();
}

if(isset($_POST['add'])==true){
   header('Location:staff_add.php');
   exit();
}

if(isset($_POST['edit'])==true){

    if(isset($_POST['staffcode'])==false){
        header('Location:staff_ng.php');
        exit();
    }
    $staff_code=$_POST['staffcode'];
        header('Location:staff_edit.php?staffcode='.$staff_code);
        exit();
}

if(isset($_POST['delete'])==true){

    if(isset($_POST['staffcode'])==false){
        header('Location:staff_ng.php');
        exit();
    }

    $staff_code=$_POST['staffcode'];
    header('Location:staff_delete.php?staffcode='.$staff_code);
    exit();
}

?>
