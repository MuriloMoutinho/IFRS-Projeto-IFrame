<?php
$footer = "
<div class='footer-fake'>
</div>

<footer class='footer'>
    <nav class='container'>
        <ul class='ul-class'>
            <div class='ops-botao ops-home'>
            <a href='home.php'>
                <li class='option-footer'>
                        <img src='{$imgHome}' alt='icon home'>
                </li>
            </a>
            </div>
            <div class='ops-botao ops-search'>
            <a href='search.php'> 
                <li class='option-footer'>
                    <img src='{$imgSearch}' alt='icon search'>
                </li>
            </a>
            </div>
            <div class='ops-botao ops-rank'>
            <a href='ranking.php'>
                <li class='option-footer'>
                    <img src='{$imgRanking}' alt='icon ranking'>
                </li>
            </a>
            </div>
            <div class='ops-botao ops-newP'>
            <a href='newPhoto.php'>
                <li class='option-footer'>
                    <img src='{$imgNewPost}' alt='icon newPhoto'>
                </li>
            </a>
            </div>
            <div class='ops-botao ops-profile'>
            <a href='profile.php?username={$_SESSION['nameSession']} '>
                <li class='option-footer'>
                    <img src='{$imgProfileFooter}' alt='icon profile'>
                </li>
            </a>
            </div>
        </ul>
    </nav>
</footer>";
?>