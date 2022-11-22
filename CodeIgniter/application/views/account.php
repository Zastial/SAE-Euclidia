
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
    <div class="user-info">
        <div class="user-profile">

            <div class="one">
                <div class="bigbold">Nom</div>
                <div><?= $this->session->user["nom"]?></div>
            </div>

            <div class="two">
                <div class="bigbold">Prénom</div>
                <div><?= $this->session->user["prenom"]?></div>
            </div>

            <div class="three-four">
                <div class="bigbold">Email</div>
                <div><?= $this->session->user["email"]?></div>
            </div>

            <div class="one-two">
                <div class="bigbold">Mot de passe</div>
                <div>******</div>
            </div>

            
            
            <div class="one-two">
                <a href="<?= site_url("user/modify") ?>" target="_parent">
                    <button class="btn btn-orange btn-large"> Modifier mes informations</button>
                </a>
            </div>

            <div class="three-four left-padding">
                <a href="" style="color : var(--red);">Supprimer le compte</a>
            </div>
        </div>
        <?php if (!is_null($factures)){ ?>
        <div class="bill-container">
        <h1 class="bill-title">Factures</h1>

        
        <?php foreach ($factures as $bill): ?>
        <!-- foreach $bills as $bill: -->

        <a href="" ><!-- renvoie vers la page pour afficher la facture selon son ID -->
            <div class="bill">
                
                <p> <?= $bill->getId() ?></p>
                <p> Facture du <?= $bill->getDate() ?></p>
                
                <img src="<?= base_url("assets/icon/icon-search.svg") ?>" alt="">
            </div>
        
            
        <?php endforeach; ?>
        <?php } ?>

        </div>
    </div>
    </div>


    

</body>
</html>


