<?php

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
    <link rel="stylesheet" href="css/index.css">
    <title>IFrame</title>
</head>

<body>

    <div class="container-inicial">
        <div class="inicial-box">
            <div class="container-info">
                <div>
                    <div class='logo'>
                        <img src='assets/icos/logo_ico1.png' alt='Iframe logo'>
                        <h1>IFrame</h1> 
                    </div>
                </div>
                
                <p>Conheça a rede social do IF, onde suas postagems bla bla bla</p>

            </div>

            <div class="container-funcional" >

                <div class="ops-funcional" >
                    <div class="ops-div">
                        <a href="login.php">Logar</a>
                    </div>

                    <div class="ops-div">
                        <a href="register.php">Criar conta</a>  
                    </div>    
                </div>
            </div>
        </div>
    </div>
</body>
</html>

