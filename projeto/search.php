<?php 
require 'components/import.php';
require_once __DIR__."/vendor/autoload.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/search.css">
    <title>IFrame - Search</title>
</head>
<body>

    <?php
    echo $header;
    ?>

    <main>
        <div class="container">
            <form action="search.php" method="get" class="form">

                <input type="search" name="search" placeholder="User search" required>

                <button type="submit" class='button'>Search</button>
            </form>

            <hr class="hr_division">

            <?php

            if(isset($_GET['search'])){
                $usuariosBuscados = User::findUser($_GET['search'],0);
            }else{
                echo "<h2>Suggestions</h2>";
                $usuariosBuscados = User::findUser('',25);
            }
            
            if(count($usuariosBuscados)){
                foreach($usuariosBuscados as $usuario){
                    echo "
                    <a href='profile.php?username={$usuario->getNome()}'>
                        <div class='flex-row-short profile-case'>
                            <img src='photos/profile/{$usuario->getFoto()}' class='profile-photo' alt='Profile picture'>
                            <div class='column'>
                                <span class='user_name_search'>{$usuario->getNome()}</span>
                                <span class='user_type_search'>{$usuario->getTurma()}</span>
                            </div>
                        </div>
                    </a>";     
                }
            }else{
                echo "<h3>No user found</h3>";
            }
            ?>

        </div>
    </main>

    <?php
    echo $footer;
    ?>    
</body>
</html>