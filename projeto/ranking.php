<?php
    require 'components/import.php';

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
    <title>IFrame</title>
</head>
<body>

    <?php
    echo $menu;

    echo $header;
    ?>

    <main>
        <div class="container">
            <h2>Ranking</h2>
            <p>Perfis com mais curitdas</p>

            <hr>
            
            <?php 
            echo "<div class='flex-row-bet'>";
                echo "<div class='flex-row-bet'>";
                    <img src="assets/istockphoto-1016744034-170667a.jpg"  class="profile-photo" alt="Foto de Perfil">
                    echo "<div>";
                        <p>Nome Perfil</p>
                        <span>Turma a1</span>
                    echo "</div>";
                echo "</div>";
                echo "<div>";
                    <img src="<?php echo $imgLike ?>" alt="Likes" class="like">
                    xx
                echo "</div>";
            echo "</div>";
            ?>



        </div>

    </main>


    <?php
        echo $footer;
    ?>   
</body>
</html>