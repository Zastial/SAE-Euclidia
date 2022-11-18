<?php 
$date = date('d/m/Y');
$disabled = empty($this->session->cart);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href= <?= base_url("css/orderCommand.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <title>ShoppingCart</title>
</head>
<body>
    <?php require_once ('header.php'); ?>

        <div class="summary">

            <div class="summary-facturation tab">
                <h4>1 Adresse de facturation</h4>
                <form action="" class="facturation">
                    <?php
                        $err = $this->session->flashdata('error');
                        if (!is_null($err)){
                            echo $err;
                        }
                        $succ = $this->session->flashdata('success');
                        if (!is_null($succ)){
                            echo $succ;
                        }
                    ?>
                    <label for="nom">Nom</label><br>
                    <input class="input" type="text" name="nom" value = "<?= $this->session->user["nom"] ?>" required> <br>
                    <label for="prenom">Prenom</label><br>
                    <input class="input" type="text" name="prenom" value = "<?= $this->session->user["prenom"] ?> " required> <br>         
                    <div>
                        <label for="rue">Numéro de rue</label><br>
                        <input class="input" type="text" name="rue" required> <br>
                        <label for="adresse">Adresse</label><br>
                        <input class="input" type="text" name="adresse" required> <br>
                    </div>
                    <label for="ville">Ville</label><br>
                    <input class="input" type="text" name="ville" required> <br>
                    <label for="code_postal">Code postal</label><br>
                    <input class="input" type="text" name="code_postal" required> <br>
                    <label for="pays">Pays</label><br>
                    <input class="input" type="text" name="pays" required> <br>
                </form>
            </div>

            <div class="payment-methods tab">
                <h4>2 Méthode de Paiement</h4>
                <div class="payment-method">
                    <div class="payment paypal">
                        <input type="radio" id="paypal" name="choose" value="1" checked>
                        <label for="paypal">Paypal</label>
                        <label for="paypal"><img src=<?= base_url("assets/image/PayPal.png")?> alt="paypal"></label>
                        
                    </div>
                    <div class="payment cb">
                        <input type="radio" id="cb" name="choose" value="1">
                        <label for="cb">Carte bancaire</label>
                        <label for="cb"><img src=<?= base_url("assets/image/cb.png")?> alt="cb"></label>
                    </div>
                    <div class="payment virement">
                        <input type="radio" id="virement" name="choose" value="1">
                        <label for="virement">Virement bancaire</label>
                        <label for="virement"><img src=<?= base_url("assets/image/virement.png")?> alt="virement"></label>
                    </div>
                </div>
            </div>

            <div class="promotion tab">
                <h4>3 Code promotionnel</h4><br>
                <div>
                    <input class="code_promo" type="text" name="code_promo">
                    <button class='btn btn-main btn-orange'> Valider code </button>
                </div>
            </div>
        </div>

        <div class='order-total'>
            <h1>Total</h1>
            <?php 
                $total = 0
            ?>
            <?php foreach($produits as $prod) :?>
                <div class="produit-total">
                    <p><?= $prod->getTitre() ?></p>
                    <p><?= $prod->getPrix() ?> €</p>
                    <?php 
                        $total += $prod->getPrix()
                    ?>
                </div>
            <?php endforeach; ?>
            <p>Total = <?= $total ?> €</p>
        </div>

</body>
</html>