<?php
    require 'components/import.php';

    require_once __DIR__."/vendor/autoload.php";
    
    if(!isset($_GET['username'])){
        header("location: home.php");
    }

    $u = User::findProfile($_GET['username']);

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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <title>Profile</title>
</head>
<body>
    
    <?php
    echo $menu;

    echo $header;
    ?>

    <main>

        <div class="container">
            
            <?php 
            if($_GET['username'] == $_SESSION['nameSession']){
                echo "<a href='editUser.php'>Edit</a>";
                echo "<a href='config/logout.php'> Logout</a>";
            }
            ?>
            

               
                <?php 
                    echo "<div class='flex-row-short'>";
                    echo "<img src='photos/profile/{$u->getFoto()}' class='profile-photo' alt='Foto de Perfil'>";
                    echo "<div class='column'>";

                    echo "<h2>{$u->getNome()}</h2>";
                    echo "<span>{$u->getTurma()}</span>";

                    echo "<div>    
                        <img src='$imgLike' alt='Likes' class='like'>
                        xx
                        </div>";

                    echo "</div>";
                    echo "</div>";

                    echo "<div class='profile-bio'>                     
                            <p>{$u->getBio()}</p>
                        </div>";
                    ?>



        </div>

        <hr class="division">

    <div class="container">
        <div class="container-posts">

        <?php 
        

        $postsProfile = Post::findProfilePost($_GET['username']);
    
        if(count($postsProfile)){
            foreach($postsProfile as $post){

                echo "<div class='post'>";    
    
                    echo "<div class='post-img'>";
                        echo "<img class='img-format' src='photos/posts/{$post->getFoto()}'  alt='Imagem Post'>";
                    echo "</div>";
                    echo "<div class='flex-row-bet'>";
                        echo "<button onclick='likePost({$post->getId()})'> <img src='{$imgLike}' class='like' alt='Like'></button>";
                        echo Like::countLikesPost($post->getId());

                        if($_GET['username'] == $_SESSION['nameSession']){

                            //echo "<form action='config/deletePost.php' method='post' >";
                              //  echo "<input type='submit' value='Delete Post' name='deletar' >";
                            //echo "</form>";
                            //$post->delete();
                    }
                    echo "</div>";

                    echo "<p>{$post->getDescricao()}</p>";
                    echo "<span>{$post->getData()}</span>";

                   

    
                echo "</div>";
            }
        }else{
            echo "Usuario sem publicações";
        }
        

        ?>


        </div>
</div>

    </main>


    
    <?php
    echo $footer;
    ?>   

<script src="likesScrip.js"></script>
</body>
</html>