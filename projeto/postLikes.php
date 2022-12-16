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
    <title>IFrame - Likes</title>
</head>
<body>
    
    <?php
    echo $menu;

    echo $header;
    ?>

    <main>
    <div class="container ">

    <div class='btns'>
        <a href="index.php" class='back-button buttonEdit'>Back</a>
    </div>
    <hr class="hr_division">
        <h1>Profiles that liked</h1>
        <hr>
        <?php 

        $profilesLike = Like::findProfileLikes($_GET['post']);

        if(count($profilesLike)){
        foreach($profilesLike as $usuario){
            echo "
            <a href='profile.php?username={$usuario->getNome()}'>
                <div class='flex-row-short profile-case'>
                    <img src='photos/profile/{$usuario->getFoto()}' class='profile-photo' alt='Profile picture'>
                    <div class='column user-data'>
                        <h2 class='user_name_search'>{$usuario->getNome()}</p>
                        <p class='user_type_search'>{$usuario->getTurma()}</p>
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