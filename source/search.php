<?php

require 'components/import.php';
require_once __DIR__ . "/vendor/autoload.php";

$results = null;
$searchTerm = null;

if (isset($_GET['search'])) {
    $results = "<h2>Results</h2>";

    $searchTerm = $_GET['search'];
    $usuariosBuscados = User::findUser($searchTerm);
} else {

    $results = "<h2>Suggestions</h2>";
    $usuariosBuscados = User::findUserSuggestion();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="css/commun.css">
    <link rel="stylesheet" href="css/search.css">
    <title>IFrame - Search</title>
</head>

<body>

    <?php
    echo $menu;

    echo $header;
    ?>

    <div class="container">

        <main>
            <form action="search.php" method="get">

                <input type="search" class="search-input" required placeholder="User search" name="search">

                <div class="div-botao-search">
                    <button type="submit" class='botao_search flex-row-short'>
                        <img src="<?php echo $imgSearchInvert ?>" class="search-img-botao" alt="Search icon">
                        <span>Search</span>
                    </button>
                </div>
        </main>

        <hr class='hr_division_search'>

        <?php

        echo $results;
        echo $searchTerm;

        if (count($usuariosBuscados)) {
            foreach ($usuariosBuscados as $usuario) {
                echo "
                        <a href='profile.php?username={$usuario->getNome()}'>
                            <div class='flex-row-short profile-case'>
                                <img src='photos/profile/{$usuario->getFoto()}' loading='lazy' class='profile-photo' alt='Profile picture'>
                                <div class='column'>
                                    <span class='user_name_search'>{$usuario->getNome()}</span>
                                    <span class='user_type_search'>{$usuario->getTurma()}</span>
                                </div>
                            </div>
                        </a>";
            }
        } else {
            echo "<h3>No user found</h3>";
        }

        ?>
    </div>

    <?php
    echo $footer;
    ?>
</body>

</html>