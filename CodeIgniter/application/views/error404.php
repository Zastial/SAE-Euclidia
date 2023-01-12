
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url=<?=base_url()?>">
    
    <link rel="stylesheet" href=<?=base_url("css/error.css")?>>
    <title>404 Erreur</title>
</head>
<body>

    <?php require_once(APPPATH.'views/main-component/header.php'); ?>    
    <section>
        <div class="error">
            <h1>Une erreur est survenue</h1>
            <p>Vous allez être redirigé vers la page d'accueuil dans 5 secondes...</p>
            <p><a href="<?=base_url()?>">Cliquez ici</a> pour revenir à la page d'accueuil.</p>
        </div>

    </section>
	
    
</body>

<?php require_once(APPPATH.'views/main-component/footer.php'); ?>

</html>


