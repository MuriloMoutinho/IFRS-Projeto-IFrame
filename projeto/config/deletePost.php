<?php
    require 'loginCheck.php';
    require_once "../vendor/autoload.php";

    $p = new Post($_POST['foto']);
    $p->setId($_POST['idPost']);
    $p->delete();
    
    header("location:../profile.php?username={$_SESSION['nameSession']}");
?>




