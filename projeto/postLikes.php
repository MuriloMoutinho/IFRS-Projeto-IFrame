<?php
    require 'components/import.php';
    require_once __DIR__."/vendor/autoload.php";
    
    if(!isset($_GET['post'])){
        header("location: home.php");
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <title>Coments</title>
</head>
<body>
    
    <?php
    echo $menu;

    echo $header;
    ?>

    <main>
    <div class="container ">

        <h1>Profiles that liked</h1>
        <hr>
        <?php 

        $profilesLike = Like::findProfileLikes($_GET['post']);

        if(count($profilesLike)){
        foreach($profilesLike as $usuario){
            echo "
            <a href='profile.php?username={$usuario->getNome()}'>
                <div class='flex-row-short profile-case'>
                    <img src='photos/profile/{$usuario->getFoto()}' class='profile-photo' alt='Foto de Perfil'>
                    <div class='column'>
                        <span>{$usuario->getNome()}</span>
                        <span>{$usuario->getTurma()}</span>
                    </div>
                </div>
            </a>";      
        }
    }else{
        echo "No likes";
    }
       
       ?>
    </div>

    </main>


    
    <?php
    echo $footer;
    ?>   

</body>
</html>