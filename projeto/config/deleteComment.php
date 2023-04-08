<?php
    require 'loginCheck.php';
    require_once "../vendor/autoload.php";
    require_once '../config/filterStrings.php';

    $c = new Comment();
    $c->setId($_GET['idComment']);
    $c->delete();

    header("location:../postComments.php?post={$_GET['idPost']}");
