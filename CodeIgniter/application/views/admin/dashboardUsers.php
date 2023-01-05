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

$triStatus = "";
if (!empty($_GET['tri-status'])) {
    $triStatus = htmlentities($_GET['tri-status']);
}

$triEtat = "";
if (!empty($_GET['tri-etat'])) {
    $triEtat = htmlentities($_GET['tri-etat']);
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
                


                    <div class="header">
                        <h1> Utilisateurs</h1>
                    </div>
                    
                    
                    <form class="form-content" method="get" id="form-filters-users" action=<?= site_url("admin/users")?>>
                        <div class="input-container">
                            <div class="input">
                                <img class="input-icon" src="<?=base_url("assets/icon/icon-search.svg")?>" alt="">
                                <input class="input-with-icon" type="text" value="<?=$rechercher?>" name="rechercher" id="rechercher" placeholder="Rechercher">
                            </div>
                        </div>

                        <div class="filters">
                            <div class="filter">
                                <label for="tri-nom">Trier :</label>
                                <select name="tri" id="tri-nom">
                                    <?php 
                                    
                                    $options = array('- Aucun filtre -', 'Tri par nom et prénom croissant', 'Tri par nom et prénom décroissant', 'Tri par email croissant', 'Tri par email décroissant');
                                    $values = array('aucun', 'nom-asc', 'nom-desc', 'email-asc', 'email-desc',);
                                
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
                                <label for="tri-status">Statut :</label>
                                <select name="tri-status" id="tri-status">
                                    <?php 
                                    
                                    $options = array('Tous', 'Administrateur', 'Responsable', 'Utilisateur');
                                    $values = array('status-tous', 'status-admin', 'status-resp','status-user');
        
                                    for ($i=0;$i<count($options);$i++) {
                                        $balise = "<option";
                                        if ($triStatus == $values[$i]) {
                                            $balise = $balise . " selected";
                                        } 
                                        $balise = $balise . " value=\"".$values[$i]."\">".$options[$i]."</option>";
                                        echo $balise;
                                    }
                                    
                                    ?>
                                </select>
                            </div>
                            <div class="filter">
                                <label for="tri-etat">Etat :</label>
                                <select name="tri-etat" id="tri-etat">
                                    <?php 
                                    
                                    $options = array('Tous', 'Actif', 'Inactif');
                                    $values = array('etat-tous', 'etat-actif', 'etat-inactif');
        
                                    for ($i=0;$i<count($options);$i++) {
                                        $balise = "<option";
                                        if ($triEtat == $values[$i]) {
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

                    <div id="Utilisateurs" class="content">
        
                        <div class="grid head">
                            <p>ID</p>
                            <p>Prénom</p>
                            <p>Nom</p>
                            <p>Email</p>
                            <p>Statut</p>
                            <p class="head-center">Etat</p>
                            <p class="head-center">Action</p>
                        </div>
        
                        <?php if (!empty($users)) :?>
                            
           
                            <?php foreach ($users as $user) :?>    
                                <div class="grid item">
                                    <p><?= $user->getId(); ?></p>
                                    <p><?= $user->getPrenom()?></p>
                                    <p><?= $user->getNom()?></p>
                                    <p class="user-email"><?= $user->getEmail()?></p>

                                    
                                    <p><?= $user->getStatus(); ?></p>

                                    <a href="<?=site_url("Admin/toggleActivation/".$user->getId())?>" class="item-center <?= $user->getEtat()=="active" ? "visible" : "invisible" ?>">
                                            <?= $user->getEtat()=="active" ? "Activé" : "Désactivé"?>
                                    </a>


                                    
                                    <div class="icon-container item-center">
                                        <a href="<?=site_url("Admin/modifUser/".$user->getID()) ?>">
                                            <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier l'utilisateur">
                                        </a>
                                        <a href="<?=site_url("Admin/factures/".$user->getID()) ?>">
                                            <img class="icon" src="<?=base_url("assets/icon/icon-request-quote.svg")?>" alt="Factures de l'utilisateur">
                                        </a>
                                    </div>
                                </div>
                    
                            <?php endforeach ; ?>
                        <?php else : ?>
                            <div class="grid item">
                                <p>Aucun utilisateur trouvé</p>
                            </div>
                        <?php endif; ?>
                
                    </div>


            <button onclick="topFunction()" id="myBtn" ><img class="icon-up" src="<?=base_url("assets/icon/icon-arrow-down.svg")?>" alt=""></button>
        </div>

        <script src="<?=base_url("js/tabAdmin.js")?>"></script>

    </body>
</html>


