<?php
require_once __DIR__ . "/vendor/autoload.php";

$error = null;
if (isset($_POST['submit'])) {

    $u = new User();
    $u->setNome($_POST['name']);
    $u->setEmail($_POST['email']);
    $u->setBio($_POST['bio']);

    $u->setSenha($_POST['password']);
    $u->setTurma($_POST['turma']);
    $u->setFoto($_FILES['foto']['name']);

    if ($u->validate()) {
        if ($u->save()) {
            if ($u->authenticate()) {
                header("location: home.php");
            } else {
                header("location: login.php");
            }
        } else {
            $error = "<div class='error'><span>We only accept files that are images</span></div>";
        }
    } else {
        $error = "<div class='error'><span>Name or email is already in use. </span></div>";
    }
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
    <link rel="stylesheet" href="css/register.css">
    <title>IFrame - Sign up</title>
</head>

<body>
    <div class="container-register">
        <div class="register-all-box">
            <div class="register-box">

                <div class="title-register">
                    <h1>Sign up</h1>
                </div>
                <div class="input-box">

                    <?php echo $error; ?>
                    
                    <form action="register.php" method="post" class="column" enctype="multipart/form-data">
                        <div class="input-text">
                            <label>User Name <input type="text" name='name' minlength="2" placeholder="min : 2 characters" maxlength="50" required></label>
                            <label>Email <input type="email" placeholder="example@email.com" name='email' required></label>
                            <label>Password <input type="password" minlength="3" name='password' placeholder="min : 3 characters" required></label>
                            <div class="select">
                                <label>Enter your class or position in IFRS<br> <select name='turma' required>

                                        <option value="" disabled selected>Select . . .</option>

                                        <?php

                                        $conexao = new MySQL();
                                        $sql = "SELECT * FROM turma order by id asc";
                                        $turmas = $conexao->consulta($sql);
                                        foreach ($turmas as $turma) {
                                            echo "<option value='{$turma['id']}'>{$turma['curso']}</option>";
                                        }
                                        ?>
                                    </select>
                                </label>
                            </div>

                            <div class="bio-input">
                                <label for='bio'>Bio</label>
                                <textarea name="bio" id='id' cols="20" rows="3" placeholder="Your biography...">Hi! I am using Iframe.</textarea>
                            </div>

                            <p>User photo</p>

                            <div class="div-user-photo">
                                <label for='foto' class="user-photo">Add your profile photo</label>

                                <div class="imgUser">
                                    <img src="photos/profile/profileDefault.jpg" id="imgPhoto">
                                </div>
                                <input type='file' accept="image/*" name='foto' id='foto' hidden class="input_photo">
                            </div>
                        </div>
                        <div class="max-width">

                        </div>
                </div>
                <script>
                    let photo = document.getElementById('imgPhoto');
                    let file = document.getElementById('foto');

                    file.addEventListener('change', () => {

                        if (file.files.length <= 0) {
                            return;
                        }

                        let reader = new FileReader();

                        reader.onload = () => {
                            photo.src = reader.result;
                        }

                        reader.readAsDataURL(file.files[0]);
                    });
                </script>
                <div class="input-button">
                    <div class="input-register">
                        <input type="submit" value="Register" name='submit'>
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