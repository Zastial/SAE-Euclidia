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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src=<?=base_url("js/tabs.js")?>></script>
    <title>Admin</title>
    
</head>
<body>
    
    <?php require_once('header.php'); ?>

    <div class="page">

        <!-- LEFT SIDE BAR -->
        
        <div class="side-bar">
            <h1>Tables</h1>
            <div class="side-bar-container">
                <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                    <div class="table" onclick="openTab(event, 'Produits')">
                        <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                        <p>Produits</p>
                    </div>
                <?php endif; ?>   
    
                <?php if ($status == "Administrateur"): ?>
                    <div class="table" onclick="openTab(event, 'Utilisateurs')">
                        <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                        <p>Utilisateur</p>
                    </div>
                <?php endif; ?>
    
                <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                    <div class="table" onclick="openTab(event, 'Categories')">
                        <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                        <p>Catégories</p>
                    </div>
                <?php endif; ?>
                

                <div onclick="">
                    <div class="table">
                        <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                        <p>Autres</p>
                    </div>
                </div>

                <div onclick="">
                    <div class="table">
                        <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                        <p>Autres</p>
                    </div>
                </div>

               
               
            </div>
            
        </div>
      
        <!-- MAIN CONTENT -->
        <div class="main">
                        
            <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
                
                
                <div id="Produits" class="content">
                    <a class="btn btn-large btn-blue-200" href= <?= site_url("Admin\addProduct")?>>Ajouter un Produit</a>
                
                    <div class="grid head">
                        <p>ID</p>
                        <p>Titre</p>
                        <p>Prix</p>
                        <p class="head-center">Visible</p>
                        <p class="head-center">Action</p>
                    </div>
                    
                    <?php foreach ($products as $product) :?>
                            <div class="grid item">
    
                                <p><?= $product->getID()?></p>
                                <p><?= $product->getTitre()?></p>
                                <p><?= $product->getPrix()?></p>
                                <a href="<?=site_url("Admin/toggleVisibility/".$product->getId())?>" class="item-center"><?= $product->getDisponible() ? "Visible a tous" : "invisible"?></a>
    
                                <div class="icon-container item-center">
                                    
                                        <a class="" href="<?=site_url("Admin/modifProduct/".$product->getID()) ?>">
                                            <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier le produit">
                                        </a>
        
                                </div>

                            </div>
                    <?php endforeach ; ?>
    
                </div>
            <?php endif; ?>
            
            
            <?php if ($status == "Administrateur"): ?>

                <div id="Utilisateurs" class="content">
    
                    <div class="grid head">
                        <p>Nom</p>
                        <p>Prénom</p>
                        <p>Email</p>
                        <p>Status</p>
                        <p class="head-center">Etat</p>
                        <p class="head-center">Action</p>
                    </div>
    
                    <?php foreach ($users as $user) :?>    
                        <div class="grid item">
                            <p><?= $user->getPrenom()?></p>
                            <p><?= $user->getNom()?></p>
                            <p class="user-email"><?= $user->getEmail()?></p>
                            <p><?= $user->getStatus(); ?></p>
                            <?php $etat = $user->getEtat(); 
                                if ($etat == "desactive") {
                                    echo '<button class="btn-user-innactif">Désactivé</button>';
                                }
                                if ($etat == "active") {
                                    echo '<button class="btn-user-actif">Activé</button>';

                                }
                            
                            ?>

                            
                            <div class="icon-container item-center">
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
    
                    <div class="grid head">
                        <p>ID</p>
                        <p>Nom de catégorie</p>
                        <p class="head-center">Action</p>
                    </div>
    
    
                    <?php foreach ($categories as $cat) :?>
    
                            <div class="grid item">
                                <p><?= $cat->getId()?></p>
                                <p><?= $cat->getLibelle()?></p>
    
                                <div class="icon-container item-center">
                                    <a href="<?=site_url("Admin/modifCategorie/".$cat->getId()) ?>">
                                        <img class="icon" src="<?=base_url("assets/icon/icon-pen.svg")?>" alt="Modifier la catégorie">
                                    </a>
                                    <!-- script utilie ? -->
                                    <script>
                                        function supprimerCategorie() {
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

    <?php require_once('footer.php'); ?>
</body>
</html>


