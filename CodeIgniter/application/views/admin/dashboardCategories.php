<?php
if (isset($this->session->user["status"])) {
    $status = $this->session->user["status"];
} else {
    $status = "";
}

$tri = "";
if (!empty($_GET['tri-categ'])) {
    $tri = htmlentities($_GET['tri-categ']);
}

$rechercher = "";
if (!empty($_GET['rechercher'])) {
    $rechercher = htmlentities($_GET['rechercher']);
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?= base_url("css/admin/admin.css") ?> >
    
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
                        <h1>Catégories</h1>
                        <a class="btn btn-large btn-orange btn-shadow-orange" href= <?= site_url("Admin/addCategorie")?>>+ Ajouter une Catégorie</a>
                    </div>

                    <form class="form-content" method="get" id="form-filters-categories" action=<?= site_url("admin/categories")?>>
                        <div class="input-container">
                            <div class="input">
                                <img class="input-icon" src="<?=base_url("assets/icon/icon-search.svg")?>" alt="">
                                <input class="input-with-icon" value="<?=$rechercher?>" type="text" name="rechercher" id="rechercher" placeholder="Rechercher" >

                            </div>
                        </div>
                        
                        <div class="filters">
                            <div class="filter">
                                <label for="tri-prix">Trier :</label>
                                <select name="tri-categ" id="tri-categ">
                                    <?php 
                                    
                                    $options = array('- Aucun filtre -', 'Tri par nom croissant', 'Tri par nom décroissant');
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
                            <button type="submit" class="btn btn-large btn-orange btn-shadow-orange">Filtrer</button>
                        </div>
                        
                    
                    </form>
                        
                    <div id="Categories" class="content">
                    

                        <div class="grid head">
                            <p>ID</p>
                            <p>Nom de catégorie</p>
                            <p class="head-center">Action</p>
                        </div>

                        <?php if (!empty($categories)) :?>
                            <?php foreach ($categories as $cat) :?>

                                    <div class="grid item">
                                        <p><?= $cat->getId()?></p>
                                        <p id="libelle"><?= $cat->getLibelle()?></p>

                                        <div class="icon-container item-center">
                                            <a href="<?=site_url("Admin/modifCategorie/".$cat->getId()) ?>">
                                                <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier la catégorie">
                                            </a>

                                        

                                            <a href="<?=site_url("Admin/removeCategorie/".$cat->getId()) ?>">
                                                <img class="icon icon-delete" src="<?=base_url("assets/icon/icon-delete.svg")?>" alt="Supprimer la catégorie">
                                            </a>
                                        </div>
                                        
                                    </div>

                            <?php endforeach ; ?>
                        <?php else : ?>
                            <div class="grid item">
                                <p>Aucune catégorie trouvée</p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <button onclick="topFunction()" id="myBtn" ><img class="icon-up" src="<?=base_url("assets/icon/icon-arrow-down.svg")?>" alt=""></button>
        </div>

        <script src="<?= base_url("js/tabAdmin.js")?>"></script>
    </body>
</html>


