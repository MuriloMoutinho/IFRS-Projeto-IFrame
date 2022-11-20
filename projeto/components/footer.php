<?php


$footer = "
<div class='footer-fake'>
</div>

<footer class='footer'>
    <nav class='container'>
        <ul class='flex-row-bet'>
            <a href='home.php'>
                <li class='option-footer'>
                        <img src='{$imgHome}' alt='icon home'>
                </li>
            </a>
            <a href='search.php'> 
                <li class='option-footer'>
                    <img src='{$imgSearch}' alt='icon search'>
                </li>
            </a>
            <a href='ranking.php'>
                <li class='option-footer'>
                    <img src='{$imgRanking}' alt='icon ranking'>
                </li>
            </a>
            <a href='newPhoto.php'>
                <li class='option-footer'>
                    <img src='{$imgNewPost}' alt='icon newPhoto'>
                </li>
            </a>
            <a href='profile.php?username={$_SESSION['nameSession']} '>
                <li class='option-footer'>
                    <img src='{$imgProfileFooter}' alt='icon profile'>
                </li>
            </a>
        </ul>
    </nav>
</footer>";