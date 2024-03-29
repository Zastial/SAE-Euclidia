<?php 
    $connected = (isset($this->session->user)) ? true : false;
    $status = ($connected) ? $this->session->user["status"] : "";
?>


<head>
    <link rel="shortcut icon" type="image/x-icon" href=<?=base_url("assets/icon/favicon.ico");?>>
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/components/header.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/main-css/reset.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>
</head>

<html>
    <body>
        <nav class="main-navbar">
            <div class="nav-container">
                <a href=<?= site_url("Home") ?>>
                    <img class="euclidia-icon" id="euclidia-icon-header" src="/assets/image/logo_euclidia.svg" alt="Euclidia" style="width: 12rem;">
                </a>
            
            
                <ul class="nav-center">
                    <li><a class="link-nav" href=<?= site_url("Home") ?>>Accueil</a></li> 
                    <li><a class="link-nav" href=<?= site_url("Product/find") ?>>Modèles 3D</a></li>
                    <li><a class="link-nav" href=<?= site_url("Contact") ?>>Contact</a></li>
                </ul>
            
        
                <div class="nav-right">
                    <a class="nav-cart-container"href= <?= site_url("ShoppingCart")?>>
                        <?php if (!empty($_SESSION['cart']) ): ?>
                            <span class="notification_cart"><?=count($_SESSION['cart']) ?></span>
                        <?php endif; ?>
                        <img class="nav-icon shopping-cart-icon"src= <?= base_url("assets/icon/icon-shopping-cart.svg") ?>  alt="panier">
                    </a>


                    <?php if ($connected):?>
                        <div class="dropdown">
                            
                                <a class="dropbtn" href=<?=site_url("User/account")?>>
                                    <img class="nav-icon account-icon" src=<?= site_url("assets/icon/icon-account-circle.svg") ?> alt="account icon">
                                    <p><?= $this->session->user["nom"]." ".$this->session->user["prenom"] ?> </p>
                                </a>
                            
                            
                            <div class="dropdown-content">
                                <a href=<?=site_url("User/account")?>> Compte</a>
                                <?php if ($status == "Administrateur" || $status == "Responsable") : ?>
                                        <html>
                                            <a href=<?= site_url("admin") ?>>Gestion</a>
                                        </html>
                                <?php endif; ?>

                                <?php if ($status == "Utilisateur"): ?>
                                    <a href=<?=site_url("User/commandes") ?>>Mes commandes</a>
                                <?php endif; ?>  
                                <a href=<?=site_url("User/logout")?>> Déconnexion</a>
                            </div>
                        </div>


                    <?php else: ?>
                        <div class="nav-account">
                            <a href=<?= site_url("user/login")?>><button class="btn-nav">Connexion</button></a>
                            <a href=<?= site_url("user/register")?>><button class="btn-nav">S'inscrire</button></a>
                        </div>
                    <?php endif ;?>
                    
                    
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox-switcher">
                            <input type="checkbox" id="checkbox-switcher" />
                            <span id="dark-mode-toggle" class="dark-mode-toggle slider round"></span>
                        </label>
                    </div>
                
                </div>
            </div>
        </nav>
    


        <script src="<?=base_url("js/dark_mode.js")?>"></script>
    </body>
    
    <?php require_once(APPPATH.'views/error.php'); ?>
</html>
