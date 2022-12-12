
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/account.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/bill.css") ?>>

    <title>Account</title>
</head>
<body>

    <?php require_once('header.php'); ?>
    <section>


        <div class="user-info">
            <div class="user-profile">


                <div class="left">
                    <h1>Profile</h1>

                    <div class="one">
                        <div class="bigbold">Nom</div>
                        <p><?= $this->session->user["nom"]?></p>
                    </div>
        
                    <div class="two">
                        <div class="bigbold">Prénom</div>
                        <p><?= $this->session->user["prenom"]?></p>
                    </div>
        
                    <div class="three-four">
                        <div class="bigbold">Email</div>
                        <p><?= $this->session->user["email"]?></p>
                    </div>
        
                    <div class="one-two">
                        <div class="bigbold">Mot de passe</div>
                        <div>******</div>
                    </div>
                </div>

                <div class="one-two">
                    <a href="<?= site_url("user/modify") ?>" target="_parent">
                        <button class="btn btn-orange btn-large"> Modifier mes informations</button>
                    </a>
                </div>
    
                
                
                <div class="right">
                    <div class="one-two">
                        <div class="bigbold">Numéro de rue</div>
                        <div><?= $user->getNumRue()?></div>
                    </div>
    
                    <div class="adresse">
                        <div class="bigbold">Adresse</div>
                        <div><?= $user->getAdresse()?></div>
                    </div>
                    
                    <div class="ville">
                        <div class="bigbold">Ville</div>
                        <div><?= $user->getVille()?></div>
                    </div>
                    
                    <div class="one-two">
                        <div class="bigbold">Code Postal</div>
                        <div><?= $user->getPostalCode()?></div>
                    </div>
                    
                    <div class="pays">
                        <div class="bigbold">Pays</div>
                        <div><?= $user->getPays()?></div>
                    </div>
                </div>
                
                
                <div class="one-two">
                    <a href="<?= site_url("user/modifyAddress") ?>"><button class="btn btn-orange btn-large"> Modifier mon adresse</button></a>
                </div>

            </div>
            <div class="three-four left-padding">
                <a href="" style="color : var(--red);">Supprimer le compte</a>
            </div>
            
            
        </div>
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
            <?php endif ?>    
        
            </div>
        </div>
        


    </section>    

    

</body>


<?php require_once('footer.php'); ?>

</html>


