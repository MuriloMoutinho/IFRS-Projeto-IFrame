<?php
    require 'components/import.php';
    require_once __DIR__."/vendor/autoload.php";
    
    if(isset($_POST['submit'])){
        if(!empty($_FILES['newPhoto']['name'])){

            $post = new Post($_SESSION['idSession'],$_FILES['newPhoto']['name']);
            $post->setDescricao($_POST['descricao']);
            $post->save();

            header("location: profile.php?username={$_SESSION['nameSession']}");
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
    <link rel="stylesheet" href="css/newPhoto.css">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <title>IFrame</title>
</head>
<body>


    <?php
    echo $menu;
    
    echo $header;
    ?>

    <main>
        <div class="container ">

            <form action="newPhoto.php" method="post" enctype="multipart/form-data">

                <label for="input-img" class="box-photo center">
                    <div id="img-content">

                    </div>
                </label>

                <input type="file" accept="image/*" name="newPhoto" class="input-img" id="input-img" >
                
                <label for='desc'>Descrição:</label>
                <textarea name="descricao" id='desc' cols="20" rows="3" ></textarea>                 


                <button type="submit" name="submit" class="button-publish" >Publicar</button>
            </form>

        </div>
    </main>
    
    <script>

        const labelcontent = document.querySelector("#img-content");
        const contentDefault = `
        <img src="<?php echo $imgNewPostInvert ?>" alt="" class="like">
        <h2>Adicionar fotos</h2>
        <span>Clique aqui para adicionar uma nova foto</span>`
        labelcontent.innerHTML = contentDefault;
        const inputFile = document.querySelector("#input-img");

        inputFile.addEventListener("change", function (e) {
            const inputTarget = e.target;
            const file = inputTarget.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function (e) {
                const readerTarget = e.target;

                const img = document.createElement("img");
                img.src = readerTarget.result;
                img.classList.add("img-format");

                labelcontent.innerHTML = "";
                labelcontent.appendChild(img);
                });

                reader.readAsDataURL(file);
            } else {

            }
        });

    </script>


    <?php
    echo $footer;
    ?>  

</body>
</html>