<?php
    require 'components/import.php';
    require 'src/Post.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

    <title>IFrame</title>
</head>
<body>


    <?php
    echo $menu;
 
    echo $header;
    ?>


    <main>
        <div class="container">

        <div class="menu-div">

            <div class="container-posts">

            <?php 
            
            $postsProfile = Post::findAllPosts();

            if(count($postsProfile)){
                foreach($postsProfile as $post){
                    
                    echo "<div class='post'>";    

                        echo "<div class='post-info'>";
                            echo "<img src='photos/profile/{$post['0']->getFoto()}' alt='Foto de Perfil'>";
                            echo "<div>";
                                echo "<p>{$post['0']->getNome()}</p>";
                                echo "<p>{$post['0']->getTurma()}</p>";
                            echo "</div>";
                        echo "</div>";

                        echo "<div class='post-img'>";
                            echo "<img class='img-format' src='photos/posts/{$post['1']->getFoto()}'  alt='Imagem Post'>";
                        echo "</div>";
                        echo "<button onclick='likePost({$post['1']->getId()})'> <img src='{$imgLike}' class='like' alt='Like'></button>";
                        echo Like::countLikesPost($post['1']->getId());
                        echo "<p>{$post['1']->getDescricao()}</p>";
                        echo "<span>{$post['1']->getData()}</span>";

                    echo "</div>";
                }
            }else{
                echo "Sem publicações disponiveis";
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