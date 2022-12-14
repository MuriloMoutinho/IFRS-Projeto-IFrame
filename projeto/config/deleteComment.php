<?php
    require 'loginCheck.php';
    require_once "../vendor/autoload.php";

    $c = new Comment();
    $c->setId($_GET['idComment']);
    $c->delete();

    header("location:../postComments.php?post={$_GET['idPost']}");
?>




