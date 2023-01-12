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
    <link rel="stylesheet" href="css/ranking.css">
    <title>IFrame - Ranking</title>
</head>
<body>

    <?php
    echo $header;
    ?>

    <main>
        <div class="container">

            <h2 class="profile-turma">Most liked profiles!</h2>
            <hr class="hr_division">
            
            <?php 
            $usuariosBuscados = User::findUsersRanking();
            foreach($usuariosBuscados as $usuario){
                echo "
                <a href='profile.php?username={$usuario->getNome()}'>
                <div class='flex-row-bet profile-case'>
                    <div class='profile-case-int'>
                        <div class='flex-row-bet'>
                            <img src='photos/profile/{$usuario->getFoto()}' class='profile-photo' alt='Profile picture'>
                            <div class='column'>
                                <span class='user_name_search'>{$usuario->getNome()}</span>
                                <span class='user_type_search'>{$usuario->getTurma()}</span>
                            </div>
                        </div>
                        <div class='like-div'>
                            <img src='{$imgLike}' alt='Like icon' class='like'>
                            {$usuario->getLikes()} Likes
                        </div>
                    </div>
                </div>
                </a>";
            }
            ?>

        </div>
    </main>

    <?php
        echo $footer;
    ?>   
</body>
</html>