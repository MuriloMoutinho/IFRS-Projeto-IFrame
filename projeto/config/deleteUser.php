<?php
    require 'loginCheck.php';
    require_once "../vendor/autoload.php";

    $u = new User();
    $u->setId($_SESSION['idSession']);
    $u->delete();
    
    session_destroy();
    header("location:../index.php");
?>




