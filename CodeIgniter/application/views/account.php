
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?= base_url("css/account.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/bill.css") ?>>

    <title>Account</title>
</head>
<body>

    <?php require_once('header.php'); ?>

    <section>

        <div class="main">

            <div class="user-info">       
                <!-- profile -->
                
                <div class="profile">
                    <h1 >Profile</h1>
                    <div class="content">
                        <h4 class="bigbold">Nom</h4>
                        <p><?= $this->session->user["nom"];?></p>
        
                        <h4 class="bigbold">Prénom</h4>
                        <p><?= $this->session->user["prenom"];?></p>
                    
                        <h4 class="bigbold">Email</h4>
                        <p><?= $this->session->user["email"];?></p>
                    
                        <h4 class="bigbold">Mot de passe</h4>
                        <p>******</p>
                    </div>
                    <a class="btn btn-orange btn-large" href="<?= site_url("User/modify") ?>" target="_parent">Modifier mes informations</a>
                    
                    
                </div>
    
                <!-- adresse -->
                <div class="adresse">
                    <h1>Adresse</h1>
                    
                    <div class="content">
                        <h4 class="bigbold">Numéro de rue</h4>
                        <p><?= $user->getNumRue();?></p>
                        <h4 class="bigbold">Adresse</h4>
                        <p><?= $user->getAdresse();?>
                    
                        <h4 class="bigbold">Ville</h4>
                        <p><?= $user->getVille();?></p>
    
                    
                        <h4 class="bigbold">Code Postal</h4>
                        <p><?= $user->getPostalCode();?></p>
    
                        <h4 class="bigbold">Pays</h4>
                        <p><?= $user->getPays();?></p>
    
                    </div>  
                    <a class="btn btn-orange btn-large" href="<?= site_url("user/modifyPersonnalAddress");?>"> Modifier mon adresse</a>               
                </div>
    
            </div>
    
          
            <!-- RIGHT -->
            <div class="bill-component">
                <?php if (!is_null($factures)): ?>
                    <div class="bill-container">
                        <h1 class="bill-title">Factures</h1>
                    
                        <?php foreach ($factures as $bill): ?>
                            
                            <a href="<?=base_url("User/getFacture/".$bill->getId())?>" target="_blank"><!-- renvoie vers la page pour afficher la facture selon son ID -->
                            <div class="bill">
                                <p> <?= $bill->getId() ?></p>
                                <p> Facture du <?= $bill->getDate() ?></p>
                                <img src="<?= base_url("assets/icon/icon-search.svg") ?>" alt="">
                            </div>
                        
                            
                        <?php endforeach; ?>
                    </div>
                <?php endif ?>   
            </div>
        </div>    


    </section>    

    

</body>


<?php require_once('footer.php'); ?>

</html>


