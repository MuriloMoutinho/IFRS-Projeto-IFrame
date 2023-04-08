<?php
require 'components/import.php';
require_once __DIR__ . "/vendor/autoload.php";
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="scripts.js" defer></script>

    <title>IFrame</title>
</head>

<body>
    <?php
    echo $menu;

    echo $header;
    ?>
    <main>
        <div class="container">
            <div class="container-posts">
                <?php

                if (isset($_GET['pagina'])) {
                    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
                }
                if (empty($pagina)) {
                    $pagina = 1;
                }

                $limiteDePosts = 50;
                $indexDoBanco = ($pagina * $limiteDePosts) - $limiteDePosts;

                $postsProfile = Post::findAllPostsPageable($indexDoBanco, $limiteDePosts);

                $ultimaPagina = Post::countPagesPosts($limiteDePosts);

                if (count($postsProfile)) {
                    foreach ($postsProfile as $post) {

                        echo "<div class='post'>
                            <a href='profile.php?username={$post['0']->getNome()}'>
                                <div class='post-info'>
                                    <img src='photos/profile/{$post['0']->getFoto()}' alt='Profile picture'>
                                        <div>
                                            <p class='profile-name'>{$post['0']->getNome()}</p>
                                            <p class='profile-turma'>{$post['0']->getTurma()}</p>
                                        </div>
                                </div>
                            </a>

                        <div class='post-img'>
                            <img class='img-format' src='photos/posts/{$post['1']->getFoto()}'  alt='Post image'>
                        </div>
                        
                        <span class='date'>{$post['1']->getData()}</span>
                        <div class='desc'>
                                    <p>{$post['1']->getDescricao()}</p>
                        </div>
                        <div class='like-botao-desc'>
                        
                            <button class='botao-like' onclick='likePost({$post['1']->getId()}); toggleElements(this)'>";

                        if (Like::checkLikePost($post['1']->getId())) {
                            echo "<img src='{$imgLikeGiv}' class='like like-ativo' ' id='img-like' alt='Like icon'>";
                        } else {
                            echo "<img src='{$imgLike}' class='like' ' id='img-like' alt='Like icon'>";
                        }

                        echo "</button>
                            <a href='postLikes.php?post={$post['1']->getId()}'>";
                        echo "<span id='numeroLikes'>" . Like::countLikesPost($post['1']->getId()) . "</span> Likes </a>";

                        echo "
                            <div class='coment-div'>
                                <a href='postComments.php?post={$post['1']->getId()}'><img class='coments-img' src='assets/icos/coment_ico1.png' alt='Comments icon'>" . Comment::countCommentPost($post['1']->getId()) . " Comments</a>
                            </div>
                            
                    </div>
                    </div><hr class='hr_division'>";
                    }
                } else {
                    echo "<h2>No posts</h2>";
                }

                ?>

                <div class='paginacao'>
                    <?php
                    if ($pagina != 1) {
                        echo "<a href='?pagina=1'>Primeira página</a>";
                    }
                    if ($pagina > 1) {
                        $paginaAnterior = $pagina - 1;
                        echo "<a href='?pagina={$paginaAnterior}'>❮</a>";
                    }
                    echo "Página: " . $pagina;
                    if ($pagina < $ultimaPagina) {
                        $proximaPagina = $pagina + 1;
                        echo "<a href='?pagina={$proximaPagina}'>❯</a>";
                    }
                    if ($pagina != $ultimaPagina) {
                        echo "<a href='?pagina={$ultimaPagina}'>Última página</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    echo $footer;
    ?>
</body>

</html>