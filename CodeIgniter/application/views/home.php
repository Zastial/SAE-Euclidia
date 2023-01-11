
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?= base_url("css/home.css") ?>>

    <title>Accueil</title>
</head>


<body> 
    <section>
        <?php require_once ('header.php'); ?>
        
        <div class="welcome-section">
            <div class="modele">

                <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script> 
                <!-- auto-rotate -->
                <model-viewer camera-controls rotation-per-second="300%" auto-rotate-delay="0" src="<?= site_url("Resource/getRandomHomeModel")?>" alt="A 3D model of an astronaut"></model-viewer>
               

            </div>
            <div class="content">
                <div class="info">
                    <h1>Découvrez nos nouveaux modèles</h1>
                    <a href=<?= site_url("Product/find")?>><button class="btn btn-black-200 btn-border-orange">Explorer</button></a>
                </div>
            </div>
        </div>
    

    </section>
        


</body>


<?php require_once('footer.php'); ?>

</html>



