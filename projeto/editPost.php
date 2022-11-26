<?php
    require 'components/import.php';
    require_once __DIR__."/vendor/autoload.php";


    $post = Post::findPost($_SESSION['idPostSession']);

    if(isset($_POST['edit'])){

        $post->setDescricao($_POST['descricao']);
        $post->save();

        header("location:../profile.php?username={$_SESSION['nameSession']}");

    }elseif(isset($_POST['delete'])){

        $post->detele();

        header("location:../profile.php?username={$_SESSION['nameSession']}");
    }

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <title>Edit Post</title>
</head>
<body>
    
    <?php
    echo $menu;
    echo $header;
    ?>

    <main>
        <h1>Edit</h1>

        <div class='post'>
            <div class='post-img'>
            <?php echo "<img class='img-format' src='photos/posts/{$post->getFoto()}'  alt='Imagem Post'>" ?>
            </div>
            <div class='flex-row-bet'>
                <?php echo Like::countLikesPost($post->getId()) ?>
            </div>

            <?php echo "<span>{$post->getData()}</span>" ?>
        </div>

        <form action="editPost.php" method="post">
            <?php
                echo  "<label for='desc'>Biografia:</label>
                <textarea name='descricao' id='desc' cols='20' rows='3' >{$post->getDescricao()}</textarea>";
            ?>
            <input type="submit" value="edit" name='edit'>

            <input type="submit" value="Delete post" name='delete'>
        </form>
    </main>

    <?php
    echo $footer;
    ?>   

</body>
</html>