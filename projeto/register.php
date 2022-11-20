<?php 

if(isset($_POST['submit'])){

    require 'src/User.php';

    $u = new User($_POST['email'],$_POST['password']);
    $u->setNome($_POST['name']);
    $u->setTurma($_POST['turma']);

    $u->setBio($_POST['bio']);
    $u->setFoto($_FILES['foto']['name']);

    if($u->validate()){

        $u->save();
        header("location: login.php");
    }else{
        header("location: register.php");
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
    <title>Cadastrar</title>
</head>
<body>
    
    <div class="center"> 
        <div class="column login-box">
            
            <h1>Registration</h1>
            <form action="register.php" method="post" class="column" enctype="multipart/form-data">
                <label>User Name <input type="text" name='name' required></label>
                <label>Email <input type="email" name='email' required></label>
                <label>Password <input type="password" name='password' required></label>
                <label>Qual sua turma: <select name='turma'>

                    <?php 
                       require 'src/Configuracao.php';
                       require 'src/MySQL.php';

                        $conexao = new MySQL();
                        $sql = "SELECT * FROM turma order by id asc";
                        $turmas = $conexao->consulta($sql);
                        foreach($turmas as $turma){
                            echo "<option value='{$turma['id']}'>{$turma['curso']}</option>";
                        }
                    ?>     
                </select>
                </label>
                
                <label> Biografia: <textarea name="bio" cols="20" rows="6" ></textarea></label>

                
                <label>Photo <input type='file' accept="image/*" name='foto'></label>

                <input type="submit" value="Register" name='submit'>

            </form>
            <a href="index.php">Back</a>

        </div>
    </div>

</body>
</html>