<?php

if(isset($_POST['disp'])==true){

    if(isset($_POST['opuscode'])==false){
        header('Location:opu_ng.php');
      　exit();
    }

    $opu_code=$_POST['opuscode'];
    header('Location:opu_disp.php?opuscode='.$opu_code);
    exit();
}

if(isset($_POST['add'])==true){
   header('Location:opu_add.php');
   exit();
}

if(isset($_POST['edit'])==true){

    if(isset($_POST['opuscode'])==false){
        header('Location:opu_ng.php');
        exit();
    }
    $opu_code=$_POST['opuscode'];
        header('Location:opu_edit.php?opuscode='.$opu_code);
        exit();
}

if(isset($_POST['delete'])==true){

    if(isset($_POST['opuscode'])==false){
        header('Location:opu_ng.php');
        exit();
    }

    $opu_code=$_POST['opuscode'];
    header('Location:opu_delete.php?opuscode='.$opu_code);
    exit();
}

?>
