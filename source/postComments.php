<?php
require 'components/import.php';
require_once __DIR__ . "/vendor/autoload.php";

if (isset($_POST['submit'])) {
    $c = new Comment();
    $c->setConteudo($_POST['comentario']);
    $c->setUsuario($_SESSION['idSession']);
    $c->setPost($_GET['post']);

    $c->save();
}

$comments = Comment::findPostComment($_GET['post']);
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
    <title>IFrame - Comments</title>
</head>

<body>

    <?php
    echo $menu;

    echo $header;
    ?>

    <main>
        <div class='container'>

            <div class='btns'>
                <a href="index.php" class='back-button buttonEdit'>Back</a>
            </div>

            <form <?php echo "action='postComments.php?post={$_GET['post']}'"; ?> method='post'>
                <div class='desc-post'>

                    <label for='comment'>
                        <textarea name='comentario' id='comment' maxlength='100' cols='20' rows='3' required></textarea>
                        <div class='post-comment-input-div'>
                            <input class="post-comment-input" type='submit' value='Post comment' name='submit'>
                        </div>

                </div>
            </form>

            <hr>

            <?php

            if (count($comments)) {
                foreach ($comments as $comment) {

                    echo "
                    <div class='column links-delete profile-case'>
                        <a href='profile.php?username={$comment['0']->getNome()}'>
                            <div class='post-info'>
                                <img src='photos/profile/{$comment['0']->getFoto()}' loading='lazy' alt='Profile picture'>
                                <div>
                                    <p class='user_name_search'>{$comment['0']->getNome()}</p>
                                    <p class='user_type_search'>{$comment['0']->getTurma()}</p>
                                </div>
                            </div>
                        </a>
                        <span>{$comment['1']->getConteudo()}</span>
                        <span class='date'>{$comment['1']->getData()}</span>
                   </div>";

                    if ($comment['1']->getUsuario() == $_SESSION['idSession']) {
                        echo "<a class='delete_comment' href='config/deleteComment.php?idComment={$comment['1']->getId()}&idPost={$_GET['post']}'>Delete Comment</a>";
                    }
                }
            } else {
                echo "No comments, be the first to make a comment!";
            }

            ?>

        </div>
    </main>

    <?php
    echo $footer;
    ?>

    <script src="scripts.js"></script>
</body>

</html>