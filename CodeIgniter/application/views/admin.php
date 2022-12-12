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
    <link rel="stylesheet" href=<?= base_url("css/admin.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>
    <script type="text/javascript" src=<?=base_url("js/tabs.js")?>></script>
    <title>Admin</title>
</head>
<body>
    
    <?php require_once('header.php'); ?>

    <div class="page">

        <!-- LEFT SIDE BAR -->
        <div class="side-bar">
            <h1>Tables</h1>
            <ul>
                <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                    <li><a class="tab-link" onclick="openTab(event, 'Produits')" ><!--<img src="assets/icon/icon-account-circle.svg" alt="">--> Produits</a></li>
                <?php endif; ?>   
    
                <?php if ($status == "Administrateur"): ?>
                    <li><a class="tab-link" onclick="openTab(event, 'Utilisateurs')">Utilisateur</a></li>
                <?PHP endif; ?>
    
                <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                    <li><a class="tab-link" onclick="openTab(event, 'Categories')">Catégories</a></li>
                <?php endif; ?>
                
                <li><a href="">autres</a></li>
                <li><a href="">autres</a></li>
                <li><a href="">autres</a></li>
                <li><a href="">autres</a></li>
            </ul>
            
    
            
        </div>
      
        <!-- MAIN CONTENT -->
        <div class="main">
                        
            <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                
                
                <div id="Produits" class="content">
                    <a class="btn btn-large btn-blue-200" href= <?= site_url("Admin\addProduct")?>>Ajouter un Produit</a>
                
                    <div class="head-grid">
                        <p>ID</p>
                        <p>Titre</p>
                        <p>Prix</p>
                        <p>Disponible</p>
                        <p>Action</p>
                    </div>
                    
                    <?php foreach ($products as $product) :?>
                            <div class="item">
    
                                <p><?= $product->getID()?></p>
                                <p><?= $product->getTitre()?></p>
                                <p><?= $product->getPrix()?></p>
                                <p><?= $product->getDisponible() ? "oui" : "non"?></p>
    
                                <div class="icon-container">
                                    <a href="<?=site_url("Admin/modifProduct/".$product->getID()) ?>">
                                        <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier le produit">
                                    </a>
                                </div>
                                
                            </div>
                    <?php endforeach ; ?>
    
                </div>
            <?php endif; ?>
            
            
            <?php if ($status == "Administrateur"): ?>

                <div id="Utilisateurs" class="content">
    
                    <div class="head-grid">
                        <p>Nom</p>
                        <p>Prénom</p>
                        <p>Email</p>
                        <p>Status</p>
                        <p>Action</p>
                    </div>
    
                    <?php foreach ($users as $user) :?>
    
    
                            <div class="item">
                                <p> <?= $user->getPrenom()?></p>
                                <p><?= $user->getNom()?></p>
                                <p><?= $user->getEmail()?></p>
                                <p><?= $user->getStatus(); ?></p>
    
                                
                                <div class="icon-container">
                                    <a href="<?=site_url("Admin/modifUser/".$user->getID()) ?>">
                                        <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier l'utilisateur">
                                    </a>
                                </div>
                            </div>
            
                    <?php endforeach ; ?>
            
                </div>
            <?php endif; ?>
    
            <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
            
                
                <div id="Categories" class="content">
                    <a class="btn btn-large btn-blue-200" href= <?= site_url("Admin\addCategorie")?>>Ajouter une Catégorie</a>
    
                    <div class="head-grid">
                        <p>ID</p>
                        <p>Nom de catégorie</p>
                        <p>Action</p>
                    </div>
    
    
                    <?php foreach ($categories as $cat) :?>
    
                            <div class="item">
                                <p><?= $cat->getId()?></p>
                                <p><?= $cat->getLibelle()?></p>
    
                                <div class="icon-container">
                                    <a href="<?=site_url("Admin/modifCategorie/".$cat->getId()) ?>">
                                        <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier la catégorie">
                                    </a>
                                    <!-- script utilie ? -->
                                    <script>
                                        function supprimerCategorie() {
                                            var x;
                                            var r = confirm("Voulez-vous vraiment supprimer la catégorie ?");
    
                                            if (r == true) {
                                                window.location.href = "<?= site_url("Admin/removeCategorie/".$cat->getId()) ?>";
                                            }
                                        }
                                    </script>
                                    <a href="<?=site_url("Admin/removeCategorie/".$cat->getId()) ?>">
                                        <img class="icon icon-delete" src="<?=base_url("assets/icon/icon-delete.svg")?>" alt="Supprimer la catégorie">
                                    </a>
                                </div>
                                
                            </div>
    
                    <?php endforeach ; ?>
                </div>
            <?php endif; ?>
        </div>



        <button onclick="topFunction()" id="myBtn" ><img class="icon-up" src="<?=base_url("assets/icon/icon-arrow-down.svg")?>" alt=""></button>
    </div>

    <?php /*require_once('footer.php'); */?>
</body>
</html>


