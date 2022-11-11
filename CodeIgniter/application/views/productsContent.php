<div id="produits">
    <table>
        <thead>
            <tr>
                <th> id </th>
                <th> name </th>
                <th> price</th>
                <th> description </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produits as $prod) :?>
                <tr>
                    <td> <img src="" alt="modèle <?= $prod->getTitre() ?>"> </td>
                    <td> <?= $prod->getTitre() ?></td>
                    <td> <?= $prod->getPrix() ?></td>
                    <td> <?= $prod->getDescription()?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>