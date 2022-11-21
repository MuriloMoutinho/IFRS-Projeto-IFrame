<?php
    require 'loginCheck.php';
    require '../src/Post.php';

    $p = new Post(0,'');
    $p->setId();
    $p->delete();

    header("location:../profile.php?username={$_SESSION['nameSession']}");
?>




