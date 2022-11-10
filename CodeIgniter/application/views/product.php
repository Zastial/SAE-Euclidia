
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= base_url("css/reset.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <title>Contact</title>
</head>
<body>
    
    <?php require_once ('header.php'); ?>


    <div class="image">


    </div>

    <div >
        <h1 class ="" > <?= $product->getTitre() ?> </h1>
        <p> <?= $product->getDescription() ?> </p>
    </div>

    <div class="">
        <h3> <?= $product->getPrix() ?></h3>
        <button> <img src="" alt=""> Ajouter au panier</button>
    </div>





</body>
</html>

