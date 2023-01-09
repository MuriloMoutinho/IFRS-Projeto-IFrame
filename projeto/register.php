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
    <header class="header">
        <div class="container container-header">
            <div class="header-logo">
                <img class="img-logo" src='assets/icos/logo_ico2_1.ico' alt='IFrame logo'>
                <h1 class="title-logo">IFrame</h1>
            </div>
            <h1>Sign up</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <?php 
            require_once __DIR__."/vendor/autoload.php";

            if(isset($_POST['submit'])){
            
                $u = new User();
                $u->setNome($_POST['name']);
                $u->setEmail($_POST['email']);
                $u->setBio($_POST['bio']); 
            
                $u->setSenha($_POST['password']);
                $u->setTurma($_POST['turma']);
                $u->setFoto($_FILES['foto']['name']);
            
                if($u->validate()){
                    if($u->save()){
                        header("location: login.php");
                    }else{
                        echo "<div class='error'><span>We only accept files that are images</span></div>";
                    }
                }else{
                    echo"<div class='error'><span>Name or email is already in use. </span></div>";
                }
            }
            ?>
            <form action="register.php" method="post" class="form" enctype="multipart/form-data">
                <label for="name">User Name</label>
                <input type="text" name='name' id="name" minlength="2" placeholder="min: 2 characters"  maxlength="50" required>

                <label for="email">Email</label>
                <input type="email" name='email' id="email" placeholder="example@email.com" required>

                <label for="password">Password</label>
                <input type="password" name='password' id="password" minlength="3" placeholder="min: 3 characters" required>

                <label for="turma">Enter your class or position in IFRS</label>
                <select name='turma' id="turma" required>
                    <option value="" disabled selected >Select . . .</option>
                    <?php 
                    $conexao = new MySQL();
                    $sql = "SELECT * FROM turma order by id asc";
                    $turmas = $conexao->consulta($sql);
                    foreach($turmas as $turma){
                        echo "<option value='{$turma['id']}'>{$turma['curso']}</option>";
                    }
                    ?>
                </select>

                <label for='bio'>Bio</label>
                <textarea name="bio" id='bio' placeholder="Your biography...">Hi! I am using Iframe.</textarea>

                <label for='foto' class="user-photo">Add your profile photo</label>
                <img src="photos/profile/profileDefault.jpg" id="imgPhoto" class="profile-img">
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

                <div class="button-div">
                    <input type="submit" value="Register" name='submit' class="button">
                    <a href="index.php" class="button">Cancel</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>