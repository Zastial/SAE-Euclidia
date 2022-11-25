
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?= base_url("css/typographie.css") ?>>
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>   
    <link rel="stylesheet" href=<?= base_url("css/home.css") ?>>

    
    <title>Accueil</title>
</head>


<body>

    <section>
        <?php require_once ('header.php'); ?>
        
        <div class="welcome-section">
            <div class="content">
                <div class="info">
                    <h1>Découvrez nos nouveau modèles</h1>
                    <a href=<?= site_url("Product/find")?>><button class="btn btn-black-200">Explorer</button></a>
                </div>
            </div>
        </div>
        
        <h2>encore du text</h2>
        <h2>encore du text</h2>
        <h2>encore du text</h2>
        <h2>encore du text</h2>
        <h2>encore du text</h2>
        <h2>encore du text</h2>
        <h2>encore du text</h2>
        <h2>encore du text</h2>



    </section>
        


</body>


<?php require_once('footer.php'); ?>

</html>



