<?php
    require 'loginCheck.php';
    require '../src/User.php';

    $u = User::find($_SESSION['idSession']);
    $u->delete();

    
    session_destroy();
    header("location:../index.php");
?>




