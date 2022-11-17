
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <title>Account</title>
</head>
<body>
    
    <?php require_once('header.php'); ?>
    <div class="user-info">
        <div class="user-profile">
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <th> <p class=" "> <?= $this->session->user["nom"]?> </p> </th>
                    <th> <p class=" "> <?= $this->session->user["prenom"]?> </p> </th>
                    <th> <p class=" "> <?= $this->session->user["email"] ?> </p> </th>
                </tr>
            </table>
    
            <button class="btn btn-large" > Modifier le profil</button>
        </div>
        <div class="user-password">
            <div>
            <div>
                <h3>Mot de passe</h3>
                <p>******</p>
                <button class="btn btn-large">Modifier le mot de passe</button>
            </div>
            
            <div>
                <a href="" style="color : var(--red);">Supprimer le compte</a>
            </div>
        </div>

    </div>


    <div class="bill-container">
        <h1 class="bill-title">Factures</h1>

        
        <?php  ?>
        <!-- foreach $bills as $bill: -->

        <a href="" ><!-- renvoie vers la page pour afficher la facture selon son ID -->
            <div class="bill">
                <img src="<?= base_url("assets/image/default-img.png") ?>" alt="default image of modele">
                <p> <!-- bill.getID() --> 1</p>
                <p> Facture 01/01/2022 <!-- bill.getDate() --></p>
                <p> 19:00  <!-- bill.getHour --> </p>
                <img src="<?= base_url("assets/icon/icon-search.svg") ?>" alt="">
            </div>
        </a>
            
        <!-- endforeach; -->
        <?php ?>

        </div>
    </div>

</body>
</html>


