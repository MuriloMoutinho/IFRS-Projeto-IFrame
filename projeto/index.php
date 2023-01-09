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
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/index.css">
    <title>IFrame</title>
</head>
<body>
    <header class="header">
        <div class="container container-header">
            <div class="header-logo">
                <img class="img-logo" src='assets/icos/logo_ico2_1.ico' alt='IFrame logo'>
                <h1 class="title-logo">IFrame</h1>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <p class="paragrafo">
                IFrame is basically an image-sharing social network based on Instagram and Fotolog for interaction  among everyone who attends IFRS Feliz.
            </p>
            <p class="paragrafo">
                As a final project for the 3rd Year of the Computer Technician High School course, it was proposed that we used all we learned throughout the year to develop a project that would have some impact and could be used by everyone. With that in mind, our choice was to make a social network.
            </p>
            <div class="button-div">
                <a href="login.php" class="button">Sign in</a>
                <a href="register.php" class="button">Create account</a>
            </div>
        </div>
    </main>
</body>
</html>