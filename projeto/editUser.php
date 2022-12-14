<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <title>Profile</title>
</head>
<body>
    
    <?php
    require 'components/import.php';

    echo $menu;

    echo $header;
    ?>

    <main>

    <div class="center container"> 
        <div class="login-box">
            <h1>Edit</h1>

<?php
require_once __DIR__."/vendor/autoload.php";


$usuarioConsulta = User::find($_SESSION['idSession']);

if(isset($_POST['submit']) || isset($_POST['remove'])){

$u = new User();

if(password_verify($_POST['currentPass'],$usuarioConsulta->getSenha())){
    $u->setSenha($_POST['newPassword']);
}else{
    echo"<div class='error'><span>Wrong password. </span></div>";
}
$u->setNome(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
$u->setEmail(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$u->setBio(filter_var($_POST['bio'], FILTER_SANITIZE_STRING)); 

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
}
?>

            <form action="editUser.php" method="post" class="column" enctype="multipart/form-data">
                <?php


                echo "<label for='userName'>UserName: </label>
                <input type='text' name='name' id='userName' class='input' maxlength='50' minlength='2' value='{$usuarioConsulta->getNome()}' required>
                <label for='email'>Email: </label>
                <input type='email' name='email' id='email' value='{$usuarioConsulta->getEmail()}' required>
                
                <label for='turma'>Escolha a sua turma: </label>
                <select id='turma' name='turma'>";
                
                $conexao = new MySQL();
                $sql = "SELECT * FROM turma order by id asc";
                $turmas = $conexao->consulta($sql);

                foreach($turmas as $turma){ 

                    echo "<option ".($turma['id'] == $usuarioConsulta->getTurma() ? "selected":"")." value='{$turma['id']}'>{$turma['curso']}</option>";
                    }
                        
                echo "</select>
                <label for='biografia'>Bio: </label>
                <textarea name='bio' id='biografia' cols='20' rows='6' >{$usuarioConsulta->getBio()}</textarea>";
                
                ?>
                <label for="foto" >Foto: </label>
                <input type='file' accept='image/*' name='foto' id="foto"> 
                <input type='submit' value='remove photo' name='remove'>
                
                <label for="currentPass">Write your current password:</label>
                <input type='password' name='currentPass' id="currentPass">
                <label for="newPassword" >write your new password: </label>
                <input type='password' minlength='3' name='newPassword' id="newPassword">

                <input type='submit' value='Edit' name='submit'>
                
            </form>
            <a href="config/deleteUser.php">Deletar conta</a>
            <a href="index.php">Back</a>
        </div>
    </div>

    </main>

    <?php
    echo $footer;
    ?>   
</body>
</html>