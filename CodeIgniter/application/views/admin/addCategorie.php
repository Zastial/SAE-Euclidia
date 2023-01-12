<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= base_url("css/admin/addCategorie.css") ?> >


    <title>Document</title>
</head>
<body>

    <?php  require_once(APPPATH.'views/main-component/error.php'); ?>

    <?php require_once(APPPATH.'views/main-component/header.php'); ?> 


    <section>
        
        <div class="return">
            <a class="btn btn-orange" href=<?= site_url("admin/categories")?>> <img src="" alt=""> < Retour  </a>
        </div>
        
        
        <?php echo form_open('admin/addCategorie'); ?>

            <h1>Ajouter une catégorie</h1>

        
                
            <div class="nom">
                <label for="name" class="labelTypo" size="30" required>Nom de la catégorie</label>
                <input class="" type="text" name="name" required>
                <?php echo form_error('name'); ?>
            </div>

        
            
            <div class="validation">
                <button class="btn btn-orange btn-main"type="submit">Créer une nouvelle catégorie</button>
            </div>
        

        </form>



    </section>



</body>

    <?php require_once(APPPATH.'views/main-component/footer.php'); ?> 
</html>