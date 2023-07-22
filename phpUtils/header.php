<?php

if (!isset($_SESSION)) {
    session_start();
}

echo
'<header>
<h1>MangAttack</h1>
<nav>
<label for="menu-toggle" class="menu-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></label>
    <ul class="menu-dropdown">';
if (isset($_SESSION['loggedin']) == 1 && $_SESSION['loggedin'] == 1) {
    if (test_admin($_SESSION['identifier']) == 1) {
        echo '<li><a href="admin.php">Admin</a></li>';
    }
}

echo '<li><a href="index.php">Accueil</a></li>
        <li><a href="#">Nouveautés</a></li>
        <li><a href="category.php">Catégories</a></li>
        <li><a href="profile.php">';

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1)) {
    echo 'Connexion';
} else {
    echo 'Mon Compte';
}
echo '</a></li>
        <li><a href="cart.php">Panier</a></li>
    </ul>
</nav>
</header>';
