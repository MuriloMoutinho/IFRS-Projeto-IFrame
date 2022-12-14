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
    <title>Search</title>
</head>
<body>

    <?php
    echo $menu;

    echo $header;
    ?>     
    
    <div class="container">

        <main>
            <form action="search.php" method="get">

                <input type="search" class="search-input" required placeholder="Search" name="search">

                <button type="submit" class='flex-row-short'>
                    <img src="<?php echo $imgSearchInvert ?>" class="like" alt="">
                    <span>Search</span>
                </button>
        </main>
        
        <hr>

        <?php

                if(isset($_GET['search'])){
                    $usuariosBuscados = User::findUser($_GET['search'],0);
                }else{
                    echo "<h2>Suggestion</h2>";
                    $usuariosBuscados = User::findUser('',25);
                }
                
                foreach($usuariosBuscados as $usuario){
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
        
        ?>

    </div>

  
<?php
echo $footer;
?>     

</body>
</html>