<?php
    require 'components/import.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <title>IFrame</title>
</head>
<body>
 
<?php
echo $header;
?>
    <main>
        <div class="container">

            <div class="container-posts">

            
            <div class="post">
                
                <div class="post-info">
                    <img  src="assets/istockphoto-1016744034-170667a.jpg" alt="">
                    <div>
                        <p class="">Nome Usuario</p>
                        <p>turma A1</p>
                    </div>
                </div>
            
                <div class="post-img">
                    <img class="img-format" src="assets/img.jpg" alt="">
                </div>
                <img src="<?php echo $imgLike ?>" class="like" alt="">
            </div>

            <div class="post">
                
                <div class="post-info">
                    <img  src="assets/istockphoto-1016744034-170667a.jpg" alt="">
                    <div>
                        <p class="">Nome Usuario</p>
                        <p>turma A1</p>
                    </div>
                </div>
            
                <div class="post-img">
                    <img class="img-format" src="assets/photo-1606946887361-78feb162a525.jfif" alt="">
                </div>
                <img src="<?php echo $imgLike ?>" class="like" alt="">

            </div>

            <div class="post">
                
                <div class="post-info">
                    <img src="assets/istockphoto-1016744034-170667a.jpg" alt="">
                    <div>
                        <p class="">Nome Usuario</p>
                        <p>turma A1</p>
                    </div>
                </div>
            
                <div class="post-img">
                    <img class="img-format" src="assets/espacoo.jpg" alt="">
                </div>
                <img src="<?php echo $imgLike ?>" class="like" alt="">

            </div>

            <div class="post">
                
                <div class="post-info">
                    <img src="assets/istockphoto-1016744034-170667a.jpg" alt="">
                    <div>
                        <p class="">Nome Usuario</p>
                        <p>turma A1</p>
                    </div>
                </div>
            
                <div class="post-img">
                    <img class="img-format" src="assets/gif.gif" alt="">
                </div>
                <img src="<?php echo $imgLike ?>" class="like" alt="">

            </div>


        

        </div>

        
    </div>
    </main>

    <?php
        echo $footer;
    ?>   

</body>
</html>