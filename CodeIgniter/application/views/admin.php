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

    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/tabs.css") ?> >
    <script type="text/javascript" src=<?=base_url("js/tabs.js")?>></script>
    <title>Admin</title>
</head>
<body>
    
    <?php require_once('header.php'); ?>
    <div class="main">
        <div class="tab-container">
            <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                <button class="tab-link" onclick="openTab(event, 'Produits')">Produits</button>
            <?php endif; ?>
    
            <?php if ($status == "Administrateur"): ?>
                <button class="tab-link" onclick="openTab(event, 'Utilisateurs')">Utilisateurs</button>
            <?PHP endif; ?>

            <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                <button class="tab-link" onclick="openTab(event, 'Categories')">Categories</button>
            <?php endif; ?>
        </div>
    
    
        <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
        <div id="Produits" class="tab-content">
        
            <button class="btn btn-large btn-blue-200">Ajouter un Produit</button>
            
            <?php foreach ($products as $product) :?>
                    <div class="item-container">
                        <p><?= $product->getID()?></p>
                        <p><?= $product->getTitre()?></p>
                        <p><?= $product->getPrix()?></p>
                        <p><?= $product->getDisponible() ? "oui" : "non"?></p>
                        <div class="icon-container">
                            <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier le produit">
                            <img class="icon icon-delete" src="<?=base_url("assets/icon/icon-delete.svg")?>" alt="Supprimer le produit">
                        </div>
                        
                    </div>
    
            <?php endforeach ; ?>
        </div>
        <?php endif; ?>
        
        
        <?php if ($status == "Administrateur"): ?>
        <div id="Utilisateurs" class="tab-content">
            
            <button class="btn btn-large btn-blue-200">Ajouter un Utilisateur</button>

            <?php foreach ($users as $user) :?>

                <?php $statusUser = $user->getStatus(); 
                
                
                ?>
                    <div class="item-container">
                        <p> <?= $user->getPrenom()?></p>
                        <p><?= $user->getNom()?></p>
                        <p><?= $user->getEmail()?></p>
                        <select id="status">
                            <option value="Administrateur">Administrateur</option>
                            <option value="Responsable">Responsable</option>
                            <option value="valeur3">Utilisateur</option>
                        </select>
                        <div class="icon-container">
                            <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier le produit">
                            <img class="icon icon-delete" src="<?=base_url("assets/icon/icon-delete.svg")?>" alt="Supprimer le produit">
                        </div>
                    </div>
    
            <?php endforeach ; ?>
    
        </div>
        <?php endif; ?>

        <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
        <div id="Categories" class="tab-content">

            <button class="btn btn-large btn-blue-200">Ajouter une Catégotie</button>    

            <?php foreach ($categories as $cat) :?>
                    <div class="item-container">
                        <p><?= $cat->getId()?></p>
                        <p><?= $cat->getLibelle()?></p>
                        <div class="icon-container">
                            <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier la catégorie">
                            <img class="icon icon-delete" src="<?=base_url("assets/icon/icon-delete.svg")?>" alt="Supprimer la catégorie">
                        </div>
                        
                    </div>

            <?php endforeach ; ?>
        </div>
        <?php endif; ?>
    </div>

</body>
</html>


