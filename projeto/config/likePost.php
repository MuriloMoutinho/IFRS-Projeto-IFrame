<?php
    require 'loginCheck.php';
    require '../src/Like.php';

    $l = new Like();
    $l->setPost($_POST['idPost']);
    $l->setUsuario($_SESSION['idSession']);

    if(!$l->save()){
        $l->delete();
    }

?>




