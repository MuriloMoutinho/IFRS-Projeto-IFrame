<?php
    require 'components/import.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/newPhoto.css">
    <title>IFrame</title>
</head>
<body>

<?php
echo $header;
?>

    <main>
        <div class="container ">

                <label for="input-img" class="box-photo center">
                    <div id="img-content">

                    </div>
                </label>
                <input type="file" accept="image/*" name="input-img" class="input-img" id="input-img" >
                
                <button class="button-publish">Publicar</button>

        </div>
    </main>
    
    <script>

        const labelcontent = document.querySelector("#img-content");
        const contentDefault = `
        <img src="<?php echo $imgNewPost ?>" alt="" class="like">
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