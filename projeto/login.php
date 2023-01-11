<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/login.css">
    <title>IFrame - Sign in</title>
</head>
<body>
<header class="header">
        <div class="container container-header">
            <div class="header-logo">
                <img class="img-logo" src='assets/icos/logo_ico2_1.ico' alt='IFrame logo'>
                <h1 class="title-logo">IFrame</h1>
            </div>
            <h1>Sign in</h1>
        </div>
    </header>

    <?php
    if(isset($_POST['submit'])){
        require_once __DIR__."/vendor/autoload.php";

        $u = new User();
        $u->setEmail($_POST['email']);
        $u->setSenha($_POST['password']);

        if($u->authenticate()){
            header("location: home.php");
        }else{
            echo"<div class='error'><span>Wrong email or password. </span></div>";
        }
    }
    ?>
    <main>
        <div class="container">
            <form action='login.php' method='post' class="form">
                <label for="email">Email</label>
                <input type="email" name='email' id="email" placeholder="example@email.com" required>
                <label for="password">Password</label>
                <input type="password" name='password' id="password" placeholder="min : 3 characters" required>

                <div class="button-div">
                    <input type="submit" value="Login" name='submit' class="button">
                    <a href="index.php" class="button button-waring">Cancel</a> 
                </div>
                    
            </form> 
        </div>
    </main>     
</body>
</html>