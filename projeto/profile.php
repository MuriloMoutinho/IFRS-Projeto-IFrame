<?php
    require 'components/import.php';
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

            <div class="flex-row-short">

                <img src="assets/icos/user_ico1.png"  class="profile-photo" alt="Foto de Perfil">
                
                <div class="column">
                    <h2>Nome Perfil</h2>
                    <span>Turma a1</span>
                    <div>    
                        <img src="<?php echo $imgLike ?>" alt="Likes" class="like">
                        xx
                    </div>
                </div>

            </div>

            <div class="profile-bio">
                <p>asasjdfsjdkjvndcjkvnxjkcnvdfv</p>
            </div>

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