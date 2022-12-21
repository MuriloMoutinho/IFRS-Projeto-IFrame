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
                        <h1 class="title-logo"><img class="img-logo" src='assets/icos/logo_ico1.png' alt='IFrame logo'>IFrame</h1> 
                    </div>
                    <div class="text-info">
                        <p>IFrame is basically an image-sharing social network based on Instagram and Fotolog for interaction among everyone who attends IFRS Feliz.</p>
                        <p> As a final project for the 3rd Year of the Computer Technician High School course, it was proposed that we used all we learned throughout the year to develop a project that would have some impact and could be used by everyone. With that in mind, our choice was to make a social network.</p>
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