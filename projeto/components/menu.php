<?php
$menu =
    "
    <div class='menu-div'>
    <div class='container_menu'>
    <a class='title-link' href='home.php'><div class='menu-title'>
        <img src='{$imglogo}' alt='Iframe logo'>
        <h1>IFrame</h1> 
    </div></a>
<div class='container-menu2'>
    <nav>
        <ul>
            <li>
                <a href='home.php'>
                    <div class='menu_ops'>
                        <div class='menu_ops_text'>
                            <h2>HOME</h2>
                        </div>

                        <div class='menu_img' >
                            <img src='assets/icos/home_ico1.png' alt=''>
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href='search.php'>
                    <div class='menu_ops'>
                        <div class='menu_ops_text'>
                            <h2>SEARCH</h2>
                        </div>

                        <div class='menu_img' >
                            <img src='assets/icos/search_ico1.png' alt=''>
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href='ranking.php'>
                    <div class='menu_ops'>
                        <div class='menu_ops_text'>
                            <h2>RANKING</h2>
                        </div>

                        <div class='menu_img' >
                            <img src='assets/icos/rank_ico1.png' alt=''>
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <a href='newPhoto.php'>
                    <div class='menu_ops'>
                        <div class='menu_ops_text'>
                            <h2>NEW POST</h2>
                        </div>

                        <div class='menu_img' >
                            <img src='assets/icos/post_ico1.png' alt=''>
                        </div>
                    </div>
                </a>
            </li>

            <li>
            <a href='profile.php?username={$_SESSION['nameSession']} '>
                    <div class='menu_ops'>
                        <div class='menu_ops_text'>
                            <h2>PROFILE</h2>
                        </div>

                        <div class='menu_img' >
                            <img src='assets/icos/user_ico1.png' alt=''>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
    </div>
            <div class='logout'>
                <a href='config/logout.php'><img src='assets/icos/out_ico1.png' alt=''>Sign out</a>
            </div>
</div>
</div>
";
