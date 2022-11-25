<?php
require 'components/inicial_index.php';

    session_start();
    if(isset($_SESSION['idSession'])){
        header("location:home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <title>IFrame</title>
</head>

<body>

    <div class="container-inicial">
        <div class="inicial-all-box">
            <div class="inicial-box">
                <div class="container-info">
                    <div class='logo'>
                        
                        <h1 class="title-logo"><img class="img-logo" src='assets/icos/logo_ico1.png' alt='Iframe logo'>IFrame</h1> 
                    </div>

                    <div class="text-info">
                        <?php echo $text_intro_proj?>
                        <br>
                        <br>
                        <?php echo $text_info_index?>
                    </div>
                
                

            </div>

            <div class="container-funcional" >

                <div class="ops-funcional" >
                    <div class="ops-div">
                        <a href="login.php">Sign in</a>
                    </div>

                    <div class="ops-div">
                        <a href="register.php">Create account</a>  
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

