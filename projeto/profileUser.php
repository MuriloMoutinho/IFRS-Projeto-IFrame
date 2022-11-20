<?php
    require 'components/import.php';

    require 'config/loginCheck.php';

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>
<body>
    
    <?php
    echo $menu;
    ?>

    <?php
    echo $header;
    ?>

    <main>


        <div class="container">


               
                <?php 

                    require 'src/Configuracao.php';
                    require 'src/MySQL.php';

                    $conexao = new MySQL();
                    $sqlProfile = "SELECT * FROM usuario WHERE id = {$_COOKIE['idCookie']}";
                    $usuario = $conexao->consulta($sqlProfile);

                    $sqlClass = "SELECT curso FROM turma WHERE id = {$usuario['0']['turma']}";
                    $turma = $conexao->consulta($sqlClass);

                    $usuario;
                    echo "<div class='flex-row-short'>";
                    echo "<img src='photos/profile/{$usuario['0']['foto']}' class='profile-photo' alt='Foto de Perfil'>";
                    echo "<div class='column'>";

                    echo "<h2>{$usuario['0']['nome']}</h2>";
                    echo "<span>{$turma['0']['curso']}</span>";

                    echo "<div>    
                        <img src='$imgLike' alt='Likes' class='like'>
                        xx
                        </div>";

                    echo "</div>";
                    echo "</div>";

                    echo "<div class='profile-bio'>                     
                            <p>{$usuario['0']['bio']}</p>
                        </div>";
                    ?>



        </div>

        <hr class="division">

    <div class="container">
        <div class="container-posts">

            <div class="post">
                
                <div class="post-img">
                    <img class="img-format" src="assets/img.jpg" alt="">
                </div>
                <img src="<?php echo $imgLike ?>" class="like" alt="">

            </div>

            <div class="post">
                
                <div class="post-img">
                    <img class="img-format" src="assets/img.jpg" alt="">
                </div>
                <img src="<?php echo $imgLike ?>" class="like" alt="">

            </div>    
            <div class="post">
                
                <div class="post-img">
                    <img class="img-format" src="assets/img.jpg" alt="">
                </div>
                <img src="<?php echo $imgLike ?>" class="like" alt="">

            </div>

        </div>
</div>

    </main>


    
    <?php
    echo $footer;
    ?>   

</body>
</html>