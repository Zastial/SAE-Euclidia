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
                        <div class="table">
                            <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                            <p>Produits</p>
                        </div>
                    </a>
                <?php endif; ?>   
    
                <?php if ($status == "Administrateur"): ?>
                    <a href=<?=site_url('admin/users')?> >
                        <div class="table">
                            <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                            <p>Utilisateurs</p>
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

                <?php if ($status == "Administrateur"): ?>
                        <a href=<?=site_url('admin/factures')?> >
                            <div class="table">
                                <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                                <p>Factures</p>
                            </div>
                        </a>
                <?php endif; ?>

               
            </div>
            
        </div>
      
        <!-- MAIN CONTENT -->
        <div class="main">
        </div>

        <button onclick="topFunction()" id="myBtn" ><img class="icon-up" src="<?=base_url("assets/icon/icon-arrow-down.svg")?>" alt=""></button>
    </div>


</body>
</html>


