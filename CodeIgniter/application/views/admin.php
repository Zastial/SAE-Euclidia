<?php

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <script type="text/javascript" src=<?=base_url("js/tabs.js")?>></script>
    <title>Admin</title>
</head>
<body>
    
    <?php require_once('header.php'); ?>
    
    <div class="tab-container">
        <button class="tab-link" onclick="openTab(event, 'Produits')">Produits</button>
        <button class="tab-link" onclick="openTab(event, 'Utilisateurs')">Utilisateurs</button>
    </div>

    <div id="Produits" class="tab-content">
    
        Les modèles

    </div>

    <div id="Utilisateurs" class="tab-content">
    
        Les Utilisateurs

    </div>

</body>
</html>


