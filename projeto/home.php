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
    <link rel="stylesheet" href="css/commun.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/home.css">
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
                    
                    echo "<div class='post'>
                            <a href='profile.php?username={$post['0']->getNome()}'>
                                <div class='post-info'>
                                    <img src='photos/profile/{$post['0']->getFoto()}' alt='Foto de Perfil'>
                                        <div>
                                            <p class='profile-name'>{$post['0']->getNome()}</p>
                                            <p class='profile-turma'>{$post['0']->getTurma()}</p>
                                        </div>
                                </div>
                            </a>

                        <div class='post-img'>
                            <img class='img-format' src='photos/posts/{$post['1']->getFoto()}'  alt='Imagem Post'>
                        </div>
                        
                        <span class='date'>{$post['1']->getData()}</span>
                        <div class='desc'>
                                    <p>{$post['1']->getDescricao()}</p>
                                </div>
                                <div class='like-botao-desc'>
                                    <button class='botao-like' onclick='likePost({$post['1']->getId()}); toggleElements(this)'>";

                                    if(Like::checkLikePost($post['1']->getId())){
                                        echo "<img src='{$imgLikeGiv}' class='like like-ativo' ' id='img-like' alt='Like'>";
                                    }else{
                                        echo "<img src='{$imgLike}' class='like' ' id='img-like' alt='Like'>";
                                    }
                                    
                                    echo "</button>
                                    <a href='postLikes.php?post={$post['1']->getId()}'>";
                                echo "<span id='numeroLikes'>". Like::countLikesPost($post['1']->getId()) ."</span>⠀Likes";
                                 
                            echo "</a>
                            <div class='coment-div'>
                                <a href='postComments.php?post={$post['1']->getId()}'><img class='coments-img' src='assets/icos/coment_ico1.png' alt=''><div class='comment'>".Comment::countCommentPost($post['1']->getId())."</div>⠀Comments</a>
                            </div>
                            
                    </div><hr class='hr_division'>";
                }
            }else{
                echo "<h2>No posts</h2>";
            }
            ?>
        </div>
    </div>
    </main>
    <?php
        echo $footer;
    ?>   
<script src="scripts.js"></script>
</body>
</html>