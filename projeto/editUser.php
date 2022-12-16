<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/editUser.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <title>IFrame - Profile - Edit</title>
</head>
<body>
    <?php
    require 'components/import.php';
    require_once __DIR__."/vendor/autoload.php";

    echo $menu;
    echo $header;
    ?>


<main>
<div class="container-editUser">
    <div class="editUser-all-box">
        <div class="editUser-box">

        <div class="title-editUser">
            <h1>Edit Profile</h1>
        </div>
        <div class="input-box">

<?php

    $usuarioConsulta = User::find($_SESSION['idSession']);

    if(isset($_POST['submit']) || isset($_POST['remove'])){

        $u = new User();

        if(password_verify($_POST['currentPass'],$usuarioConsulta->getSenha())){
            $u->setSenha($_POST['newPassword']);
        }else{
            echo"<div class='error'><span>Wrong password. </span></div>";
            $u->setNome($_POST['name']);
            $u->setEmail($_POST['email']);
            $u->setBio($_POST['bio']); 

            $u->setId($_SESSION['idSession']);
            $u->setTurma($_POST['turma']);

            if(isset($_POST['remove'])){
                if($usuarioConsulta->getFoto() != "profileDefault.jpg"){
                    unlink("photos/profile/".$usuarioConsulta->getFoto());
                }
                $u->setFoto("profileDefault.jpg");
        }

        if(isset($_POST['submit'])){
            if(!empty($_FILES['foto']['name'])){
                if($usuarioConsulta->getFoto() != "profileDefault.jpg"){
                    unlink("photos/profile/".$usuarioConsulta->getFoto());
                }
                $u->setFoto($_FILES['foto']['name']);
            }
        }

        if($u->validate()){
            if($u->save()){
                header("location: profile.php?username={$u->getNome()}");
            }else{
                echo "<div class='error'><span>We only accept files that are images</span></div>";
            }
        }else{
            echo"<div class='error'><span>Name or email is already in use. </span></div>";
        }
        }}
?>

            <form action="editUser.php" method="post" class="column" enctype="multipart/form-data">
                <?php


                echo "
                <div class='input-text'>
                    <label for='userName'>User Name </label>
                    <input type='text' name='name' id='userName' placeholder='min : 2 characters' class='input' maxlength='50' minlength='2' value='{$usuarioConsulta->getNome()}' required>
                    <label for='email'>Email</label>
                    <input type='email' name='email' placeholder='example@email.com' id='email' value='{$usuarioConsulta->getEmail()}' required>
                
                    <div class='select'>
                    <label for='turma'>Enter your class or position in IFRS<br>
                    <select id='turma' name='turma' required>";
                
                $conexao = new MySQL();
                $sql = "SELECT * FROM turma order by id asc";
                $turmas = $conexao->consulta($sql);

                foreach($turmas as $turma){ 

                    echo "<option ".($turma['id'] == $usuarioConsulta->getTurma() ? "selected":"")." value='{$turma['id']}'>{$turma['curso']}</option>";
                    }
                        
                echo "</select></label></div>

                <div class='bio-input'>
                    <label for='bio'>Bio</label>
                    <textarea name='bio' id='biografia' cols='20' rows='6' placeholder='Your biography...'>{$usuarioConsulta->getBio()}</textarea>
                </div>";

                ?>
                <p>User Photo</p>
                     
                

                <div class="div-user-photo">
                    <label for='foto' class="user-photo">Change your profile photo here</label>
                                
                        <div class="imgUser">
                            <img src="photos/profile/profileDefault.jpg" id="imgPhoto">
                        </div>
                            <input type='file' accept="image/*" name='foto'  id='foto' hidden class="input_photo">
                            
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
                            <div class="remove-photo-div">
                                <button class="botao-removes" type='submit' value='' name='remove'>Remove photo</button>
                            </div>
                <div>
                <details class="new-pass">
                    <summary class='change-password-button'><u>Do you want to change your password?</u></summary>

                    <div class='change-password'>
                    <label for="currentPass">Write your current password</label>
                    <input type='password' name='currentPass' id="currentPass">
                    <label for="newPassword" >Write your new password</label>
                    <input type='password' minlength='3' name='newPassword' id="newPassword">
                    </div>
                </details>
                </div>
                
                <div class="edit-photo-div">
                    <button class="botao-edits" type='submit' name='submit'>Edit profile</button>
                </div>

            </form>

            <div class='blur hide' id='blurDeleteUser'></div>
            <div class='modal_confirm hide' id='modalDeleteUser'>
                <img src='assets/icos/error.png' alt='Error icon'>
                <h3>Are you sure?</h3>
                <p>Do you really want to delete your account? This process cannot be undone</p>
                <a class='delete-button buttonEdit' href="config/deleteUser.php">Confirm</a>
                <span class='back-button buttonEdit' id='cancelDeleteUser' >Cancel</span>
            </div>
            
            <div class='btns'>
                <span class='delete-button buttonEdit' onclick="confirmDeleteUser()">Delete account</span>
                <a href="index.php" class='back-button buttonEdit'>Back</a>
            </div>
        </div>
    </div>
    </div>
    </div>

    
    </main>
    <?php
    echo $footer;
    ?>   
<script src="scripts.js"></script>
</body>
</html>