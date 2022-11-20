<?php
    require 'components/import.php';
    require 'src/User.php';

    require 'config/loginCheck.php';


    $usuarioConsulta = User::find($_SESSION['idSession']);
    
    if(isset($_POST['submit'])){
        $u = new User($_POST['email'],$_POST['password']);
        $u->setId($_SESSION['idSession']);
        $u->setNome($_POST['name']);
        $u->setBio($_POST['bio']);
        $u->setTurma($_POST['turma']);

        //$u->setFoto($_POST['foto']);

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
                echo "<label>Password <input type='password' name='password'  required></label>";
                
                echo "<label>Qual sua turma: <select name='turma'label>";

                        $conexao = new MySQL();
                        $sql = "SELECT * FROM turma order by id asc";
                        $turmas = $conexao->consulta($sql);
                        foreach($turmas as $turma){
                            echo "<option value='{$turma['id']}'>{$turma['curso']}</option>";
                        }
    
                echo "</select>";
                
                echo "<label> Biografia:<textarea name='bio' cols='20' rows='6' >{$usuarioConsulta->getBio()}</textarea> </label>";

                echo "<label> Foto: <input type='file' accept='image/*' value='photos/profile/{$usuarioConsulta->getFoto()}' name='foto'> </label>";

                ?>
                <input type='submit' value='Edit' name='submit'>
            </form>
            <a href="config/deleteUser.php"> Deletar conta </a>
            <a href="index.php">Back</a>

        </div>
    </div>

    </main>


    
    <?php
    echo $footer;
    ?>   

</body>
</html>