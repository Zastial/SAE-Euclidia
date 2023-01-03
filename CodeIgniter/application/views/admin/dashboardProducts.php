<?php
if (isset($this->session->user["status"])) {
    $status = $this->session->user["status"];
} else {
    $status = "";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?= base_url("css/admin/admin.css") ?> >
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Admin</title>
    
</head>
    <body>
        
        <?php  require_once(APPPATH.'views/error.php'); ?>

        <?php require_once(APPPATH.'views/header.php'); ?> 

        <div class="page">

            <!-- LEFT SIDE BAR -->
            
            <div class="side-bar">
                <h1>Tables</h1>
                <div class="side-bar-container">
                    <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                        <a href=<?=site_url('admin/products')?> >
                            <div class="table active">
                                <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                                <p>Produits</p>
                            </div>
                        </a>
                    <?php endif; ?>   
        
                    <?php if ($status == "Administrateur"): ?>
                        <a href=<?=site_url('admin/users')?> >
                            <div class="table">
                                <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                                <p>Utilisateur</p>
                            </div>
                        </a>
                    <?php endif; ?>
        
                    <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                        <a href=<?=site_url('admin/categories')?> >
                            <div class="table">
                                <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                                <p>Catégories</p>
                            </div>
                        </a>
                    <?php endif; ?>
                    

                    

                
                
                </div>
                
            </div>
        
            <!-- MAIN CONTENT -->
            <div class="main">
                
                <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                    
                    <div class="header">
                        <h1>Produits</h1>
                        <div class="input-container">
                            <div class="input">
                                <img class="input-icon" src="<?=base_url("assets/icon/icon-search.svg")?>" alt="">
                                <input class="input-with-icon" type="text" name="rechercher" id="rechercher" placeholder="Rechercher">
                            </div>
                        </div>

                        <!--  finir le système de tri comme dans le shop-->
                        <select name="tri" id="tri">
                            <?php 
                            
                            $options = array('- Aucun filtre -', 'Tri par prix croissant', 'Tri par prix décroissant');

                            for ($i=0;$i<count($options);$i++) {
                                $balise = "<option";
                                if ($filter == $i) {
                                    $balise = $balise . " selected";
                                } 
                                $balise = $balise . " value=\"".$i."\">".$options[$i]."</option>";
                                echo $balise;
                            }
                            
                            ?>
                        </select>
                        <a class="btn btn-large btn-orange btn-shadow-orange" href= <?= site_url("Admin/addProduct")?>>+ Ajouter un Produit</a>
                    </div>
                    
                    <div id="Produits" class="content">
                    
                        <div class="grid head">
                            <p>ID</p>
                            <p>Titre</p>
                            <p>Prix</p>
                            <p class="head-center">Visible</p>
                            <p class="head-center">Action</p>
                        </div>
                        
                        <?php foreach ($products as $product)  :?>
                            

                            <div class="grid item">

                                <p><?= $product->getID()?></p>
                                <p><?= $product->getTitre()?></p>
                                <p><?= $product->getPrix()?> €</p>
                                <a href="<?=site_url("Admin/toggleVisibility/".$product->getId())?>" class="item-center <?= $product->getDisponible() ? "visible" : "invisible" ?>">
                                    <?= $product->getDisponible() ? "Visible pour tous" : "Invisible"?>
                                </a>

                                <div class="icon-container item-center">
                                    
                                        <a class="" href="<?=site_url("Admin/modifProduct/".$product->getID()) ?>">
                                            <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier le produit">
                                        </a>
        
                                </div>

                            </div>
                        <?php endforeach ; ?>
        
                    </div>
                <?php endif; ?>
            </div>
            <button onclick="topFunction()" id="myBtn" ><img class="icon-up" src="<?=base_url("assets/icon/icon-arrow-down.svg")?>" alt=""></button>
        </div>


        <script src="<?=base_url("js/tabAdmin.js")?>"></script>
    </body>
</html>


