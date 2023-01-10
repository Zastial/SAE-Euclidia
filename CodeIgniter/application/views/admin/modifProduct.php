<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de produit</title>
    <link rel="stylesheet" href=<?= base_url("css/modifProduct.css")?>>
    <link rel="stylesheet" href=<?= base_url("css/productImage.css") ?>>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>var base_url = '<?php echo base_url() ?>';</script>
</head>
<body>
    <?php require_once(APPPATH.'views/error.php'); ?>
    <?php require_once(APPPATH.'views/header.php'); ?>

    <section>
        <?php
            $url = site_url("admin/products");
            //Méthode pour empecher de rester bloqué sur la même page lors du retour en arrière.
            if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) { //Si il y a un referer
                if ($this->session->flashdata('original-url')==NULL){   //Si on a pas d'URL sauvegardée
                    $url = htmlspecialchars($_SERVER['HTTP_REFERER']);  //
                    $this->session->set_flashdata('original-url', $url);//On sauvegarde l'URL dans une flashdata
                } else {                                                //Si il y a une url dans la flashdata
                    $url = $this->session->flashdata('original-url');   //
                    $this->session->keep_flashdata('original-url');     //On la garde pour la prochaine requete
                }
            } else {                                                    //Si il n'y a pas de referer (accès direct)
                $this->session->set_flashdata('original-url', site_url("admin/products")); //On redirige vers user/account si l'utilisateur revient en arrière
            }
        ?>
        <a class="btn btn-orange" href="<?=$url?>"> <img src="" alt=""> < Retour </a>
        
        <h1>Modification du produit</h1>

        <?php echo form_open("admin/modifProduct/".$produit->getId()) ?>
            <div>
                <label for="name">Nom du produit</label>
                <input type="text" name="name" id="name" value="<?php echo $produit->getTitre(); ?>">
                <?php echo form_error('name'); ?>
            </div>
            <div>
                <label for="price">Prix du produit</label>
                <input type="number" step="0.01" min="0" max="9999.99" name="price" id="price" value="<?php echo $produit->getPrix(); ?>">
                <?php echo form_error('price'); ?>
            </div>
            <div>
                <label for="description">Description du produit</label>
                <input type="text" name="description" id="description" value="<?php echo $produit->getDescription(); ?>">
                <?php echo form_error('description'); ?>
            </div>   

            <div class="categories">
                <?php foreach($categories as $categorie): ?>
                    <?php $labelcategorie = $categorie->getLibelle(); ?>
                    <input type="checkbox" id="<?= $labelcategorie?>" name="categories[]" value="<?php echo $categorie->getId(); ?>" <?php if (in_array($categorie, $affectations)) {echo 'checked';}?>>
                    <label for="<?= $labelcategorie?>"><?= $labelcategorie?></label>
                <?php endforeach ?>
            </div>
    
            <div class="available-container">
                <label for="disponible">Disponibilité du produit : </label>
                <select name="disponible" id="disponible">
                    <option value="oui" <?php if ($produit->getDisponible()) {echo "selected";}?>>Disponible</option>
                    <option value="non" <?php if (!$produit->getDisponible()) {echo "selected";}?>>Indisponible</option>
                </select>
            </div>

            <input class="btn btn-main btn-orange" type="submit" value="Modifier le produit">
    
        </form>
    
    </section>
</body>
<?php require_once(APPPATH.'views/footer.php'); ?>
</html>