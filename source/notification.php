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
    <link rel="stylesheet" href="css/notification.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
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

                $notificationUser = Notification::findNotification($_SESSION['idSession']);

                if (count($notificationUser)) {
                    foreach ($notificationUser as $notification) {

                        echo "
                        <div class='notification_gap'>
                            <a class='profile-case notification_box' href='postComments.php?post={$notification['1']->getId()}'>
                                <img src='photos/profile/{$notification['0']->getFoto()}' loading='lazy' alt='foto de perfil' >
                                <div>
                                    <p>{$notification['0']->getNome()} commented on your post: {$notification['2']->getConteudo()}</p>
                                    <p class='date'>{$notification['2']->getData()}</p>
                                </div>
                                <img src='photos/posts/{$notification['1']->getFoto()}' loading='lazy' class='post_notification' alt='foto da publicação'>                                
                            </a>
                            <a class='delete_notification' href='config/deleteNotification.php?idNotification={$notification['3']->getId()}'>Delete Notification</a>
                            </div>";
                    }
                } else {
                    echo "<h2>No notification</h2>";
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