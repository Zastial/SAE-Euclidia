<head>
    <link rel="stylesheet" href= <?= base_url("css/reset.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/header.css") ?> >
</head>

<nav>
    <div class="nav-container">
        <img class="nav-left" src="" alt="logo">
        
        
        <ul class="nav-center">
            <li><a href=<?= site_url("Home") ?>>Accueil</a></li> 
            <li><a href=<?= site_url("Product") ?>>Modèles 3D</a></li>
            <li><a href=<?= site_url("Contact") ?>>Contact</a></li>
        </ul>
        
    
        <div class="nav-right">
            <a href="  ">
                <img class="nav-icon shopping-cart-icon"src= <?= base_url("assets/icon/icon-shopping-cart.svg") ?> alt="panier">
            </a>
            <a href="user/login">
                <img class="nav-icon account-icon" src=<?= base_url("assets/icon/icon-account-circle.svg") ?> alt="account icon">
                Connexion
            </a>
        </div>
    </div>
</nav>