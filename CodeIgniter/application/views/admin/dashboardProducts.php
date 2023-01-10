<?php
if (isset($this->session->user["status"])) {
    $status = $this->session->user["status"];
} else {
    $status = "";
}

$tri = "";
if (!empty($_GET['tri'])) {
    $tri = htmlentities($_GET['tri']);
}

$rechercher = "";
if (!empty($_GET['rechercher'])) {
    $rechercher = htmlentities($_GET['rechercher']);
}


$prix = "";
if (!empty($_GET['tri-prix'])) {
    $prix = htmlentities($_GET['tri-prix']);
}

$visible = "";
if (!empty($_GET['tri-visible'])) {
    $visible = htmlentities($_GET['tri-visible']);
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
            
            <?php require_once(APPPATH.'views/admin/dashboard _component.php'); ?> 
                
            
        
            <!-- MAIN CONTENT -->
            <div class="main">
                
                <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                    
                    <div class="header">
                        <h1 >Produits</h1>
                        <a class="btn btn-large btn-orange btn-shadow-orange" href= <?= site_url("Admin/addProduct")?>>+ Ajouter un Produit</a>
                    </div>


                    <form class="form-content" method="get" id="form-filters-users" action=<?= site_url("admin/products")?>>
                
                    <div class="input-container">
                        <div class="input">
                            <img class="input-icon" src="<?=base_url("assets/icon/icon-search.svg")?>" alt="">
                            <input class="input-with-icon" type="text" value="<?= $rechercher?>" name="rechercher" id="rechercher" placeholder="Rechercher">
                        </div>
                    </div>

                    <div class="filters">
                        <div class="filter">
                            <label for="tri-nom">Titre :</label>
                            <select name="tri" id="tri-nom">
                                <?php 
                                
                                $options = array('- Aucun filtre -', 'Tri par titre croissant', 'Tri par titre décroissant');
                                $values = array('aucun', 'nom-asc', 'nom-desc');
                            
                                for ($i=0;$i<count($options);$i++) {
                                
                                    $balise = "<option";
                                    if ($tri == $values[$i]) {
                                        $balise = $balise . " selected";
                                    } 
                                    $balise = $balise . " value=\"".$values[$i]."\">".$options[$i]."</option>";
                                    echo $balise;
                                }
                                
                                ?>
                            </select>
                        </div>
                        <div class="filter">
                            <label for="tri-prix">Prix :</label>
                            <select name="tri-prix" id="tri-prix">
                                <?php 
                                
                                $options = array('- Aucun filtre -', 'Tri par prix croissant', 'Tri par prix décroissant');
                                $values = array('aucun', 'prix-asc', 'prix-desc');
                            
                                for ($i=0;$i<count($options);$i++) {
                                
                                    $balise = "<option";
                                    if ($prix == $values[$i]) {
                                        $balise = $balise . " selected";
                                    } 
                                    $balise = $balise . " value=\"".$values[$i]."\">".$options[$i]."</option>";
                                    echo $balise;
                                }
                                
                                ?>
                            </select>
                        </div>
                        <div class="filter">
                                <label for="tri-visible">Disponibilité :</label>
                                <select name="tri-visible" id="tri-etat">
                                    <?php 
                                    
                                    $options = array('- Aucun filtre -', 'Disponible à l\'achat', 'Indisponible à l\'achat');
                                    $values = array('aucun', 'true', 'false');
        
                                    for ($i=0;$i<count($options);$i++) {
                                        $balise = "<option";
                                        if ($visible == $values[$i]) {
                                            $balise = $balise . " selected";
                                        } 
                                        $balise = $balise . " value=\"".$values[$i]."\">".$options[$i]."</option>";
                                        echo $balise;
                                    }
                                    
                                    ?>
                                </select>
                            </div>
                        <button type="submit" class="btn btn-large btn-orange btn-shadow-orange">Filtrer</button>
                    </div>
                    </form>
                
                    <div class="">
                        <div id="Produits" class="content">
                        
                            <div class="grid head">
                                <p>ID</p>
                                <p>Titre</p>
                                <p>Prix</p>
                                <p class="head-center">Disponibilité</p>
                                <p class="head-center">Action</p>
                            </div>
                            
                            <?php if (!empty($products)) :?>
                                <?php foreach ($products as $product)  :?>
                                    
        
                                    <div class="grid item">
        
                                        <p><?= $product->getID()?></p>
                                        <p title="<?= $product->getTitre()?>"><?= $product->getTitre()?></p>
                                        <p><?= $product->getPrix()?> €</p>
                                        <a href="<?=site_url("Admin/toggleVisibility/".$product->getId())?>" class="item-center <?= $product->getDisponible() ? "visible" : "invisible" ?>">
                                            <?= $product->getDisponible() ? "Disponible à l'achat" : "Indisponible à l'achat"?>
                                        </a>
        
                                        <div class="icon-container item-center">
                                            
                                                <a class="" href="<?=site_url("Admin/modifProduct/".$product->getID()) ?>">
                                                    <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier le produit" title="Modifier le produit">
                                                </a>
                
                                        </div>
        
                                    </div>
                                <?php endforeach ; ?>
                            <?php else : ?>
                                <div class="grid item">
                                    <p>Aucun produit trouvé</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <button onclick="topFunction()" id="myBtn" ><img class="icon-up" src="<?=base_url("assets/icon/icon-arrow-down.svg")?>" alt=""></button>
        </div>


        <script src="<?=base_url("js/tabAdmin.js")?>"></script>
    </body>
</html>


