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
                echo "<div class='flex-row-short'>
                        <img src='photos/profile/{$u->getFoto()}' class='profile-photo' alt='Foto de Perfil'>
                        <div class='column'>

                        <div>
                            <h2>{$u->getNome()}</h2>
                            <span>{$u->getTurma()}</span>
                        </div>
                            <div class='like-total-user'>    
                                <img src='$imgLike' alt='Likes' class='like'>{$u->countLikesProfile()}
                            </div>
                        </div>
                    </div>

                    <div class='profile-bio'>                     
                        <p>{$u->getBio()}</p>";

                        

                        
                    echo "</div>";
                    ?>
                    <?php 
                        if($_GET['username'] == $_SESSION['nameSession']){
                            echo "<div class='edit-div'>
                                        <a href='editUser.php'><img src='assets/icos/edit_ico1.png' alt=''>Edit</a>
                                    </div>";
                        }
                    ?>


        </div>

        <hr class="division">

    <div class="container">
        <div class="container-posts">

        <?php 
        

        $postsProfile = Post::findProfilePost($_GET['username']);
    
        if(count($postsProfile)){
            foreach($postsProfile as $post){

                echo "<div class='post'>  
    
                    <div class='post-img'>
                        <img class='img-format' src='photos/posts/{$post->getFoto()}'  alt='Imagem Post'>
                    </div>

                    <span class='date'>{$post->getData()}</span>
                    <div class='desc'>
                        <p>{$post->getDescricao()}</p>
                    </div>

                    <div class='like-botao-desc'>
                    <button class='botao-like' onclick='likePost({$post->getId()}); toggleElements(this)'>
                    <img src='{$imgLike}' class='like ". ((Like::checkLikePost($post->getId())) ?  'like-ativo' : '') . " ' id='img-like' alt='Like'>
                    </button>
                        <a href='postLikes.php?post={$post->getId()}'>";
                        echo "<span id='numeroLikes'>". Like::countLikesPost($post->getId()) ."</span>";
                        echo "</a>

                        <div class='coment-div'>
                            <a href='postComments.php?post={$post->getId()}'><img class='coments-img' src='assets/icos/coment_ico1.png' alt=''><div class='comment'>".Comment::countCommentPost($post->getId())."</div>⠀Comments</a>
                        </div>
                        
                        ";
                        if($_GET['username'] == $_SESSION['nameSession']){

                            //echo "<form action='config/deletePost.php' method='post' >";
                              //  echo "<input type='submit' value='Delete Post' name='deletar' >";
                            //echo "</form>";
                            
                            //$post->delete();

                            //session
                            //post
                            //get

                    }
                    echo "</div><br><br><hr><br>";

                    

                    


                echo "</div>";
            }
        }else{
            echo "User without posts";
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