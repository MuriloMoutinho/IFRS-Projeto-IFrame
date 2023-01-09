<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/editUser.css">
    <title>IFrame - Profile - Edit</title>
</head>
<body>
    <?php
    require 'components/import.php';
    require_once __DIR__."/vendor/autoload.php";

    echo $header;
    ?>
    <main>
        <div class="container">

            <?php
            $usuarioConsulta = User::find($_SESSION['idSession']);

            if(isset($_POST['submit']) || isset($_POST['remove'])){

                $u = new User();

                if(password_verify($_POST['currentPass'],$usuarioConsulta->getSenha())){
                    $u->setSenha($_POST['newPassword']);
                }else{
                    echo"<span class='error'>Wrong password.</span>";
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
                            echo "<span class='error'>We only accept files that are images</span>";
                        }
                    }else{
                        echo"<span class='error'>Name or email is already in use.</span>";
                    }
                }
            }
            ?>

            <form action="editUser.php" method="post" class="form" enctype="multipart/form-data">
                <?php
                echo "
                    <label for='userName'>User Name</label>
                    <input type='text' name='name' id='userName' placeholder='min: 2 characters' maxlength='50' minlength='2' value='{$usuarioConsulta->getNome()}' required>
                    <label for='email'>Email</label>
                    <input type='email' name='email' placeholder='example@email.com' id='email' value='{$usuarioConsulta->getEmail()}' required>
                    
                    <label for='turma'>Enter your class or position in IFRS</label>
                    <select id='turma' name='turma' required>";

                    $conexao = new MySQL();
                    $sql = "SELECT * FROM turma order by id asc";
                    $turmas = $conexao->consulta($sql);

                    foreach($turmas as $turma){
                        echo "<option ".($turma['id'] == $usuarioConsulta->getTurma() ? "selected":"")." value='{$turma['id']}'>{$turma['curso']}</option>";
                    }
                    echo "
                        </select>
                        <label for='bio'>Bio</label>
                        <textarea name='bio' id='biografia' placeholder='Your biography...'>{$usuarioConsulta->getBio()}</textarea>";
                ?>
                <label for='foto' class="user-photo">Change your profile photo here
                    <img src="photos/profile/profileDefault.jpg" id="imgPhoto" class="profile-img">
                </label>
                <input type='file' accept="image/*" name='foto'  id='foto' hidden class="input_photo">  

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

                <button type='submit' value='' name='remove' class="button button-waring">Remove photo</button>

                <details class="details">
                    <summary class="button">Click to change your password</summary>
                    <label for="currentPass" class="details-label">Write your current password</label>
                    <input type='password' name='currentPass' id="currentPass">
                    <label for="newPassword" class="details-label">Write your new password</label>
                    <input type='password' minlength='3' name='newPassword' id="newPassword">
                </details>

                <button class="button" type='submit' name='submit'>Edit profile</button>

            </form>
            <div class='blur hide' id='blurDeleteUser'></div>

            <div class='modal_confirm hide' id='modalDeleteUser'>
                <img src='assets/icos/error.png' alt='Error icon' class="error-img">
                <h3>Are you sure?</h3>
                <p>Do you really want to delete your account? This process cannot be undone</p>
                <div class="button-div">
                    <a href="config/deleteUser.php" class='button button-modal'>Confirm</a>
                    <input type="button" class='button button-modal button-waring' id='cancelDeleteUser' value="Cancel">
                </div>
            </div>
            <div class="button-div">
                <input type="button" class='button button-waring' onclick="confirmDeleteUser()" value="Delete Account">
                <a href="index.php" class='button'>Back</a>
            </div>
        </div>
    </main>

    <?php
    echo $footer;
    ?>
<script src="scripts.js"></script>
</body>
</html>