<?php
    require 'components/import.php';
    require_once __DIR__."/vendor/autoload.php";
    
    if(isset($_POST['submit'])){
        $c = new Comment();
        $c->setConteudo($_POST['comentario']);
        $c->setUsuario($_SESSION['idSession']);
        $c->setPost($_GET['post']);

        $c->save();
    }
    if(isset($_POST['delete'])){
        $c->setId();
        $c->deletar();
    }
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
    <title>Coments</title>
</head>
<body>
    
    <?php
    echo $menu;

    echo $header;
    ?>

    <main>
    <div class='container'>
        
        <?php 

        echo "<form action='postComments.php?post={$_GET['post']}' method='post'>
                <label for='comment'>
                <textarea name='comentario' id='comment' maxlength='100' cols='20' rows='3' required ></textarea>

                <input type='submit' value='Post comment' name='submit' >
            </form>

         <hr >";


         $comments = Comment::findPostComment($_GET['post']);

         if(count($comments)){
            foreach($comments as $comment){
                
                echo "<div class='column'>";
                    echo "<a href='profile.php?username={$comment['0']->getNome()}'>";    
                        echo "<div class='post-info'>";
                            echo "<img src='photos/profile/{$comment['0']->getFoto()}' alt='Foto de Perfil'>";
                            echo "<div>";
                                echo "<p>{$comment['0']->getNome()}</p>";
                                echo "<p>{$comment['0']->getTurma()}</p>";
                            echo "</div>";
                        echo "</div>";
                    echo "</a>";

                   
                   echo "<span>{$comment['1']->getConteudo()}</span>";
                   echo "<span>{$comment['1']->getData()}</span>";
                   echo "</div>";

                   if($comment['1']->getUsuario() == $_SESSION['idSession']){
                    //echo "<input type='submit' value='delete comment' name='delete' >";
                   }

                   ;

            }
        }else{
            echo "Sem publicações disponiveis";
        }
        

         ?>
         
    </div>   
    </main>


    
    <?php
    echo $footer;
    ?>   

</body>
</html>