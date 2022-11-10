
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

    <div class="filtres">
    </div>

    
    <table>
            <thead>
                <tr>
                    <th> id </th>
                    <th> name </th>
                    <th> price</th>
                    <th> description </th>
                    <th> disponible</th>
                </tr>
            </thead>
        <tbody>
            <?php foreach($produits as $prod) :?>
                <tr>
                    <td> <img src="<?= $prod->getId()?>" alt="modèle <?= $prod->getTitre() ?>"> </td>
                    <td> <?= $prod->getTitre() ?></td>
                    <td> <?= $prod->getPrix() ?></td>
                    <td> <?= $prod->getDescription()?></td>
                    <td> <?= $prod->getDisponible() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

</body>
</html>

