<?php
    require 'loginCheck.php';
    require_once "../vendor/autoload.php";

    $n = new Notification();
    $n->setId($_GET['idNotification']);
    $n->setUsuario($_SESSION['idSession']);
    $n->delete();

    header("location:../notification.php");
