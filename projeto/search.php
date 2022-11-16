<?php
    require 'assets.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/search.css">
    <title>Search</title>
</head>
<body>
<?php
echo $header;
?>     
    
    <div class="container">


    <main>
        <div class="flex-row-short">
            <img src="assets/home.png" class="like" alt="">
            <input type="text" class="search-input" placeholder="Pesquisar">
        </div>

    </main>


    <div class="footer-fake">
    </div>
<?php
echo $footer;
?>     

</body>
</html>