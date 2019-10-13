<?php
if(isset($_POST['add'])==true){
   header('Location:keiziban_add_check.php');
   exit();
}


if(isset($_POST['edit'])==true){

    if(isset($_POST['keizibancode'])==false){
        header('Location:keiziban_ng.php');
        exit();
    }
    $keiziban_code=$_POST['keizibancode'];
        header('Location:keiziban_edit.php?keizibancode='.$keiziban_code);
        exit();
}

if(isset($_POST['delete'])==true){

    if(isset($_POST['keizibancode'])==false){
        header('Location:keiziban_ng.php');
        exit();
    }

    $keiziban_code=$_POST['keizibancode'];
    header('Location:keiziban_delete.php?keizibancode='.$keiziban_code);
    exit();
}


?>
