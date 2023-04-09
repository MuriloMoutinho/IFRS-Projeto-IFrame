<?php
    require 'loginCheck.php';
    require_once "../vendor/autoload.php";

    $p = new Post($_GET['foto']);
    $p->setId($_GET['idPost']);
    $p->setCriador($_SESSION['idSession']);
    $p->delete();
    
    header("location:../profile.php?username={$_SESSION['nameSession']}");
