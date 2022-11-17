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
    <link rel="stylesheet" href="css/search.css">
    <title>Search</title>
</head>
<body>

<div class="menu-div">
    <?php
    echo $menu;
    ?>
</div>

<?php
echo $header;
?>     
    
    <div class="container">


    <main>
        <div class="flex-row-short">
            <input type="text" class="search-input" placeholder="Pesquisar">
            <div class="search-img-ico">
                <img src="<?php echo $imgSearchInvert ?>" class="like" alt="">
            </div>
        </div>

    </main>


  
<?php
echo $footer;
?>     

</body>
</html>