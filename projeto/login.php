<?php
if(isset($_POST['submit'])){
    require_once __DIR__."/vendor/autoload.php";
    
    $u = new User();
    $u->setEmail($_POST['email']);
    $u->setSenha($_POST['password']);

    if($u->authenticate()){
        header("location: home.php");
    }else{
        header("location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/commun.css">
    <title>Sign in</title>
</head>
<body>

    <div class="container-login"> 
        <div class="login-all-box">
            <div class="login-box">

                <div class="title-login">
                    <h1>Sign in</h1>
                </div>
                <div class="input-box">
                    <form  action='login.php' method='post' class="column">
                        <div class="input-text">
                            <label>Email<input type="email" name='email' required></label>
                            <label>Password<input type="password" name='password' required></label>
                        </div>

                        <div class="input-button">
                            <div class="input-login">
                                <input type="submit" value="login" name='submit'>
                            </div>
                            <div class="voltar">
                                <a href="index.php">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>