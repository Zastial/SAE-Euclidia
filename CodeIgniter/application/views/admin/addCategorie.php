<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/tabs.css") ?> >
    <link rel="stylesheet" href=<?= base_url("css/colors.css") ?>>


    <title>Document</title>
</head>
<body>

    <?php  require_once(APPPATH.'views/error.php'); ?>

    <?php require_once(APPPATH.'views/header.php'); ?> 


    <section>

        <?php echo form_open('admin/addCategorie'); ?>

        <div class="return">
            <a class="link-nav" href=<?= site_url("Admin/index")?>> <img src="" alt=""> < Retour </a>
        </div>
        
            <h1>Ajouter une Catégorie</h1>

            <div >
                
                <div class="nom">
                    <label for="name" class="labelTypo" size="30" required>Nom de la Catégorie</label>
                    <input class="" type="text" name="name" required>
                </div>

            </div>
        
            
            <div class="validation">
                <button class="btn btn-orange btn-main"type="submit">Créer une nouveau catégorie</button>
            </div>
        

        </form>



</section>



</body>
</html>