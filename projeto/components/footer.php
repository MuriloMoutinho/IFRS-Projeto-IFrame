<?php
$footer ="
<div class='footer-fake'></div>

<footer class='footer'>
    <div class='container container-footer'>
        <nav class='footer-nav'>
            <a href='home.php' class='nav-item'>
                <img src='{$imgHome}' alt='icon home' class='nav-img'>
            </a>
            <a href='search.php' class='nav-item'> 
                <img src='{$imgSearch}' alt='icon search' class='nav-img'>
            </a>
            <a href='ranking.php' class='nav-item'>
                <img src='{$imgRanking}' alt='icon ranking' class='nav-img'>
            </a>
            <a href='newPhoto.php' class='nav-item'>
                <img src='{$imgNewPost}' alt='icon newPhoto' class='nav-img'>
            </a>
            <a href='profile.php?username={$_SESSION['nameSession']}' class='nav-item'>
                <img src='{$imgProfileFooter}' alt='icon profile' class='nav-img'>
            </a>
        </nav>
    </div>
</footer>";
?>