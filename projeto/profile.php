<?php
require 'components/import.php';

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/filterStrings.php";

if (!isset($_GET['username'])) {
    header("location: home.php");
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <title>IFrame - Profile</title>
</head>

<body>

    <?php
    echo $menu;

    echo $header;
    ?>

    <main>

        <div class="container">

            <div class='blur hide' id='blurDeletePost'></div>
            <div class='modal_confirm hide' id='modalDeletePost'>
                <img src='assets/icos/error.png' alt='Error icon'>
                <h3>Are you sure?</h3>
                <p>Do you really want to delete your post? This process cannot be undone</p>
                <a class='delete-button buttonEdit' id='confirmDeletePost'>Confirm</a>
                <span class='back-button buttonEdit' id='cancelDeletePost'>Cancel</span>
            </div>
            <?php
            
            $username = filterString($_GET['username']);

            $u = User::findProfile($username);

            if (!empty($u)) {

                echo "<div class='flex-row-short container-user'>
                        
                        <div class='column container2'>
                            <div class='name-div'>
                                <div class='photo-p'>
                                    <img src='photos/profile/{$u->getFoto()}' class='profile-photo' alt='Profile picture'>
                                    <div>
                                    <h2>{$u->getNome()}</h2>
                                    <span>{$u->getTurma()}</span>
                                    <div class='like-total-user'>
                                        <img src='$imgLike' alt='Like icon' class='like'>
                                        <p>{$u->getLikes()}</p>
                                    </div>
                                </div>
                                </div>
                                
                                
                            </div>
                            
                            <div class='profile-bio'>                     
                            <pre>{$u->getBio()}</pre>
                    </div>
                        </div>
                    </div>";


                if ($u->getId() == $_SESSION['idSession']) {
                    echo "<div class='edit-div'>
                            <a href='editUser.php'><img src='assets/icos/edit_ico1.png' alt='Edit icon'>Edit</a>
                        </div>";
                }

                echo "
        </div>
        <hr class='hr_division'>
        <div class='container'>
        <div class='container-posts'>";


                $postsProfile = Post::findProfilePost($username);

                if (count($postsProfile)) {
                    foreach ($postsProfile as $post) {

                        echo "<div class='post'>";

                        if ($_GET['username'] == $_SESSION['nameSession']) {
                            echo "<span class='delete_post' onclick='confirmDeletePost(`{$post->getId()}`,`{$post->getFoto()}`)'><img src='assets/icos/delete_ico1.png' alt='Delete post'>Delete Post</span>";
                        }

                        echo "<div class='post-img'>
                            <img class='img-format' src='photos/posts/{$post->getFoto()}' alt='Post Image'>
                        </div>

                        <span class='date'>{$post->getData()}</span>
                        <div class='desc'>
                            <p>{$post->getDescricao()}</p>
                        </div>

                        <div class='like-botao-desc'>
                            <button class='botao-like' onclick='likePost({$post->getId()}); toggleElements(this)'>";

                        if (Like::checkLikePost($post->getId())) {
                            echo "<img src='{$imgLikeGiv}' class='like like-ativo' ' id='img-like' alt='Like icon'>";
                        } else {
                            echo "<img src='{$imgLike}' class='like' ' id='img-like' alt='Like icon'>";
                        }

                        echo "</button>";

                        echo "<a href='postLikes.php?post={$post->getId()}'>
                                <span id='numeroLikes'>" . Like::countLikesPost($post->getId()) . "</span> Likes
                            </a>

                            <div class='coment-div'>
                                <a href='postComments.php?post={$post->getId()}'><img class='coments-img' src='assets/icos/coment_ico1.png' alt='Comment icon'>" . Comment::countCommentPost($post->getId()) . " Comments</a>
                            </div>
                        </div>";

                        echo "</div>
                    <hr class='hr_division'>";
                    }
                } else {
                    echo "<span>No posts</span>";
                }
            } else {
                echo "<h2>No user found</h2>";
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