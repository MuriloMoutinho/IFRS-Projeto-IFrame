<?php
if(isset($_POST['submit'])){


    require 'src/User.php';

    $u = new User($_POST['email'],$_POST['password']);
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

    <div class="center"> 
        <div class="column login-box">
            
            <h1>Login</h1>
            <form  action='login.php' method='post' class="column">
                <label>Email <input type="email" name='email' required></label>
                <label>Password <input type="password" name='password' required></label>
                <input type="submit" value="login" name='submit'>
                <a href="index.php">Back</a>
            </form>

        </div>
    </div>

    <a href="home.php">Link temporario que redireciona para a HOME</a>
</body>
</html>