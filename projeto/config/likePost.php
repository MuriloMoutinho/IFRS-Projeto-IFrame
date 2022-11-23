<?php
    require 'loginCheck.php';
    require_once "../vendor/autoload.php";

    $l = new Like();
    $l->setPost($_POST['idPost']);
    $l->setUsuario($_SESSION['idSession']);

    if(!$l->save()){
        $l->delete();
    }

?>




