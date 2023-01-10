<?php
if (isset($this->session->user["status"])) {
    $status = $this->session->user["status"];
} else {
    $status = "";
}

$tri = "";
if (!empty($_GET['tri-id'])) {
    $tri = htmlentities($_GET['tri-id']);
}

$rechercher = "";
if (!empty($_GET['rechercher'])) {
    $rechercher = htmlentities($_GET['rechercher']);
}

$triPrix = "";
if (!empty($_GET['tri-prix'])) {
    $triPrix = htmlentities($_GET['tri-prix']);
}

$triDate = "";
if (!empty($_GET['tri-date'])) {
    $triDate = htmlentities($_GET['tri-date']);
}

if (!empty($_GET['user-id'])) {
    $id = htmlentities($_GET['user-id']);
}

if (!isset($id)) {
    $id = "";
}

$minDate = "";
if (!empty($_GET['minDate'])) {
    $minDate = htmlentities($_GET['minDate']);
}
$maxDate = "";
if (!empty($_GET['maxDate'])) {
    $maxDate = htmlentities($_GET['maxDate']);
}

var_dump($minDate);
var_dump($maxDate);
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
                

                    <h1 class="header">Factures</h1>
                    
                    <form class="form-content" method="get" id="form-filters-users" action=<?= site_url("admin/factures")?>>
                        
                        <input type="hidden" value="<?= $id ?>" name="user-id">

                        <div class="filters">
                            <div class="filter">
                                <label for="tri-id">Identifiant :</label>
                                <select name="tri-id" id="tri-id">
                                    <?php 
                                    
                                    $options = array('- Aucun filtre - ', 'ID utilisateur croissant', 'ID utilisateur décroissant');
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
                                    
                                    $options = array('- Aucun filtre -', 'Prix croissant', 'Prix décroissant');
                                    $values = array('etat-tous', 'nom-asc', 'nom-desc');
            
                                    for ($i=0;$i<count($options);$i++) {
                                        $balise = "<option";
                                        if ($triPrix == $values[$i]) {
                                            $balise = $balise . " selected";
                                        } 
                                        $balise = $balise . " value=\"".$values[$i]."\">".$options[$i]."</option>";
                                        echo $balise;
                                    }
                                    
                                    ?>
                                </select>
                            </div>

                            <div class="filter">
                                <label for="tri-date">Date :</label>
                                <select name="tri-date" id="tri-date">
                                    <?php
                                    $options = array('- Aucun filtre -', 'Du plus ancien au plus récent', 'Du plus récent au plus ancien');
                                    $values = array('aucun', 'nom-asc', 'nom-desc');
            
                                    for ($i=0;$i<count($options);$i++) {
                                        $balise = "<option";
                                        if ($triDate == $values[$i]) {
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
                        <div class="date-filter">
                            <div class="filter">
                                <div class="input-container">
                                    <div class="input">
                                        <label for="date-debut">A partir du :</label>
                                        <input class="" type="date" value="<?=$minDate?>" name="minDate" id="date-debut" >
                                    </div>
                                </div>
                                <div class="input-container">
                                    <div class="input">
                                        <label for="date-fin">Jusqu'au :</label>
                                        <input class="" type="date" value="<?=$maxDate?>" name="maxDate" id="date-fin" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="Utilisateurs" class="content">
        
                        <div class="grid head">
                            <p>ID facture</p>
                            <p>ID utilisateur</p>
                            <p class="head-center">Total</p>
                            <p class="head-center">Date</p>
                            <p class="head-center">Action</p>
                        </div>
        
                        <?php if (!empty($factures)) :?>
                            
           
                            <?php foreach ($factures as $fact) :?>    
                                <div class="grid item">
                                    <p><?= $fact->getId()?></p>
                                    <p><?= $fact->getUserId()?></p>
                                    <p class="head-center"><?= $fact->getTotal();?> €</p>
                                    <p class="head-center"><?= $fact->getDate();?></p>
                                    
                                    
                                    <div class="icon-container item-center">
                                        <a href="<?=site_url("user/getfacture/".$fact->getId()) ?>" target="_blank">
                                            <img class="icon" src="<?=base_url("assets/icon/icon-eye.svg")?>" alt="Voir la facture" title="Voir la facture">
                                        </a>
                                    </div>
                                </div>
                    
                            <?php endforeach ; ?>
                        <?php else : ?>
                            <div class="grid item">
                                <p>
                                    Aucune facture trouvée.
                                    <?php 
                                    var_dump($minDate > $maxDate);
                                    if (!empty($minDate) && !empty($maxDate) && $minDate > $maxDate) {
                                        echo "Attention, les dates de début et de fin ne correspondent pas à l'ordre chronologique.";
                                    }
                                    ?>
                                </p>
                            </div>
                        <?php endif; ?>
                
                    </div>

            <button onclick="topFunction()" id="myBtn" ><img class="icon-up" src="<?=base_url("assets/icon/icon-arrow-down.svg")?>" alt=""></button>
        </div>

        <script src="<?=base_url("js/tabAdmin.js")?>"></script>

    </body>
</html>


