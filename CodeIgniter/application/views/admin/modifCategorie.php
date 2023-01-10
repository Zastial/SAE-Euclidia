<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href=<?= base_url("css/modifCategorie.css")?>>
    <title>modifCategorie</title>
</head>
<body>
    <?php require_once(APPPATH.'views/error.php'); ?>
    <?php require_once(APPPATH.'views/header.php'); ?>
    
    <section>
        <?php
            $url = site_url("admin/categories");
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
                $this->session->set_flashdata('original-url', site_url("admin/categories")); //On redirige vers adin/categories si l'utilisateur revient en arrière
            }
        ?>
        <a class="btn btn-orange" href="<?=$url?>"> <img src="" alt=""> < Retour </a>
        <?php echo form_open("admin/modifCategorie/".$categorie->getId()) ?>
        <h1>Modifier une catégorie</h1>
    
            <label for="name">Nom de la categorie</label>
            <input type="text" name="name" id="name" value="<?php echo $categorie->getLibelle(); ?>">
            <?php echo form_error('name'); ?>
    
            <input class="btn btn-main btn-orange" type="submit" value="Modifier la catégorie">

        </form>
    </section>


    <?php require_once(APPPATH.'views/footer.php'); ?>

    
</body>
</html>