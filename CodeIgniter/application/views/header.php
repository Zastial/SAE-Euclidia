<?php 
    $connected = (isset($this->session->user)) ? true : false;
    $status = ($connected) ? $this->session->user["status"] : "";
?>


<head>
    <link rel="stylesheet" href= <?= base_url("css/reset.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/header.css") ?> >

    <style>
        .dropbtn {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 10px;
            align-items: center;
            background-color: #FFFFFF;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
  
        .dropdown {
            position: relative;
            display: inline-block;
        }
  
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 
                0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
  
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
  
        .dropdown-content a:hover {
            background-color: #f1f1f1
        }
  
        .dropdown:hover .dropdown-content {
            display: block;
        }
  
        .dropdown:hover .dropbtn {
            background-color: #FFFFFF;
        }
    </style>
</head>

<nav>
    <div class="nav-container">
        <a href="home">
            <img class="nav-left" src="" alt="logo">
        </a>
        
        
        <ul class="nav-center">
            <li><a href=<?= site_url("Home") ?>>Accueil</a></li> 
            <li><a href=<?= site_url("Product") ?>>Modèles 3D</a></li>
            <li><a href=<?= site_url("Contact") ?>>Contact</a></li>
        </ul>
        
    
        <div class="nav-right">
            <a href= <?= site_url("ShoppingCart")?>>
                <img class="nav-icon shopping-cart-icon"src= <?= base_url("assets/icon/icon-shopping-cart.svg") ?>  alt="panier">
            </a>


            <div class="dropdown">
                <button class="dropbtn">
                    <img class="nav-icon account-icon" src=<?= base_url("assets/icon/icon-account-circle.svg") ?> alt="account icon">
                    <?php if ($connected):?>
                        <p ><?= $this->session->user["nom"].$this->session->user["prenom"] ?> </p>
                    <?php endif ;?>
                </button>
                
                <div class="dropdown-content">

                    <a href=<?= (isset($this->session->user)) ? base_url("User/account") : base_url("User/login") ?>> Compte</a>



                    <?php if ($connected): ?>
                        <?php if ($status == "Utilisateur") : ?>
                            
                            <html>
                                <a href=<?= site_url("user/logout") ?>> Se déconnecter</a>
                            </html>
                            


                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>

            

            
            
        </div>
    </div>
</nav>