<?php
    require 'components/import.php';
    require 'src/User.php';

    require 'config/loginCheck.php';


    $usuarioConsulta = User::find($_SESSION['idSession']);



    if(isset($_POST['submit']) || isset($_POST['remove'])){

        $u = new User();

        if(password_verify($_POST['nowPassword'],$usuarioConsulta->getSenha())){
            $u->setSenha($_POST['newPassword']);
        }

        $u->setEmail($_POST['email']);
        $u->setId($_SESSION['idSession']);
        $u->setNome($_POST['name']);
        $u->setBio($_POST['bio']);
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
            $u->save();
            header("location: profile.php");
        }else{
            header("location: editUser.php");
        }
    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/register.css">
    <title>Profile</title>
</head>
<body>
    
    <?php
    echo $menu;
    ?>

    <?php
    echo $header;
    ?>

    <main>

    <div class="center"> 
        <div class="column login-box">
            
            <h1>Edit</h1>
            <form action="editUser.php" method="post" class="column" enctype="multipart/form-data">
                <?php

                echo "<label>User Name <input type='text' name='name' value='{$usuarioConsulta->getNome()}' required></label>";
                echo "<label>Email <input type='email' name='email' value='{$usuarioConsulta->getEmail()}' required></label>";
                
                echo "<label>Qual sua turma: <select name='turma'label>";
                
                $conexao = new MySQL();
                $sql = "SELECT * FROM turma order by id asc";
                $turmas = $conexao->consulta($sql);

                foreach($turmas as $turma){ 

                    echo "<option ".($turma['id'] == $usuarioConsulta->getTurma() ? "selected":"")." value='{$turma['id']}'>{$turma['curso']}</option>";
                    }
                        
                echo "</select>";
                echo "<label> Biografia:<textarea name='bio' cols='20' rows='6' >{$usuarioConsulta->getBio()}</textarea> </label>";
                        
                
                ?>
                <label> Foto: <input type='file' accept='image/*' name='foto'> </label>
                <input type='submit' value='remove photo' name='remove'>
                
                
                <label>Actual Password <input type='password' name='nowPassword' ></label>
                <label>New Password <input type='password' name='newPassword' ></label>

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