<?php
if(isset($_POST['submit'])){


    require 'src/User.php';

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
    <link rel="stylesheet" href="css/commun.css">
    <title>Login</title>
</head>
<body>

    <div class="container-login"> 
        <div class="column login-all-box">
            <div class="login-box">

            
                <div class="title-login">
                    <h1>Login</h1>
                </div>
            
                <div class="input-box">
                    <form  action='login.php' method='post' class="column">
                        <label>Email <input type="email" name='email' required></label>
                        <label>Password <input type="password" name='password' required></label>
                        <input type="submit" value="login" name='submit'>
                        <a href="index.php">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>