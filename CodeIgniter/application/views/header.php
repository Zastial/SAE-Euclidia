<?php 

    $connected = (isset($this->session->user)) ? true : false;
    $status = ($connected) ? $this->session->user["status"] : "";
?>


<head>
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/header.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>

</head>

<nav>
    <div class="nav-container">
        <a href=<?= site_url("Home") ?>>
            <img src="/assets/image/euclidia_logo.png" alt="Euclidia" style="width: 12rem;">
        </a>
        
        
        <ul class="nav-center">
            <li><a class="link-nav" href=<?= site_url("Home") ?>>Accueil</a></li> 
            <li><a class="link-nav" href=<?= site_url("Product/find") ?>>Modèles 3D</a></li>
            <li><a class="link-nav" href=<?= site_url("Contact") ?>>Contact</a></li>
        </ul>
        
    
        <div class="nav-right">
            <a href= <?= site_url("ShoppingCart")?>>
                <img class="nav-icon shopping-cart-icon"src= <?= base_url("assets/icon/icon-shopping-cart.svg") ?>  alt="panier">
            </a>


            <?php if ($connected):?>
            <div class="dropdown">
                
                    <a class="dropbtn" href=<?=base_url("User/account")?>>
                        <img class="nav-icon account-icon" src=<?= base_url("assets/icon/icon-account-circle.svg") ?> alt="account icon">
                        <p ><?= $this->session->user["nom"]." ".$this->session->user["prenom"] ?> </p>
                    </a>
                
                
                <div class="dropdown-content">

                    <a href=<?=base_url("User/account")?>> Compte</a>

                
                    <?php if ($status == "Administrateur" || $status == "Responsable") : ?>
                            <html>
                                <a href=<?= site_url("admin") ?>>Gestion</a>
                            </html>
                    <?php endif; ?>
                    
                    <a href=<?=base_url("User/logout")?>> Déconnexion</a>
                </div>
            </div>


            <?php else: ?>
                <div>
                    <a class="btn-nav" href=<?= site_url("user/login")?>>Connexion</a>
                    <a class="btn-nav" href=<?= site_url("user/register")?>>S'inscrire</a>
                </div>
            <?php endif ;?>

            

            
            
        </div>
    </div>
</nav>
<?php require_once('error.php'); ?>