<?php
    require 'components/import.php';
    require_once __DIR__."/vendor/autoload.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/newPhoto.css">
    <title>IFrame - New Post</title>
</head>
<body>

    <?php
    echo $header;
    ?>

    <main>
        <div class="container ">

            <?php 
            if(isset($_POST['submit'])){
                if(!empty($_FILES['newPhoto']['name'])){

                    $post = new Post($_FILES['newPhoto']['name']);
                    $post->setCriador($_SESSION['idSession']);
                    $post->setDescricao($_POST['descricao']);

                    if($post->save()){
                        header("location: profile.php?username={$_SESSION['nameSession']}");    
                    }else{
                        echo "<div class='error'><span>We only accept files that are images</span></div>";
                    }
                }
            }
            ?>

            <form action="newPhoto.php" method="post" enctype="multipart/form-data" class="form">

                <label for="input-img">
                    <div id="img-content" class="newPost-div"></div>
                </label>

                <input type="file" accept="image/*" name="newPhoto" id="input-img" class="input-img" required >
                
                <label for='desc'>Description</label>
                <textarea name="descricao" id='desc' cols="20" rows="4" ></textarea>    

                <input type="submit" name="submit" value="Post" class="button button-accept">

            </form>

        </div>
    </main>
    
    <script>
        const labelcontent = document.querySelector("#img-content");
        const contentDefault = `
        <img src="<?php echo $imgNewPostInvert ?>" alt="New Post icon" class="newPost-plus">
        <h2>Add photo</h2>
        <span>Click here to add a new photo</span>`
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
            }else{

            }
        });
    </script>

    <?php
    echo $footer;
    ?>

</body>
</html>