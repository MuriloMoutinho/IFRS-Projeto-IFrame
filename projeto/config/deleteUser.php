<?php
    require 'loginCheck.php';
    require_once "../vendor/autoload.php";

    $u = User::find($_SESSION['idSession']);
    $u->delete();
    
    session_destroy();
    header("location:../index.php");
?>