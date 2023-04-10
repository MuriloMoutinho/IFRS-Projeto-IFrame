<?php
$error = null;
if (isset($_POST['submit'])) {
    require_once __DIR__ . "/vendor/autoload.php";

    $u = new User();
    $u->setEmail($_POST['email']);
    $u->setSenha($_POST['password']);

    if ($u->authenticate()) {
        header("location: home.php");
    } else {
        $error = "<div class='error'><span>Wrong email or password. </span></div>";
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
    <title>IFrame - Sign in</title>
</head>

<body>

    <div class="container-login">
        <div class="login-all-box">
            <div class="login-box">

                <div class="title-login">
                    <h1>Sign in</h1>
                </div>
                <div class="input-box">


                    <?php echo $error; ?>
                    <form action='login.php' method='post' class="column">
                        <div class="input-text">
                            <label>Email<input type="email" name='email' placeholder="example@email.com" required></label>
                            <label>Password<input type="password" name='password' placeholder="min : 3 characters" required></label>
                        </div>

                        <div class="input-button">
                            <div class="input-login">
                                <input type="submit" value="Login" name='submit'>
                            </div>
                            <div class="voltar">
                                <a href="index.php">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>