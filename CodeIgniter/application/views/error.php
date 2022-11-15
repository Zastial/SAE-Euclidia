<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?= base_url("css/component.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?> >
    <title>Accueil</title>
</head>
<body>
    
    <?php require_once ('header.php'); ?>

    <h1>Une erreur est survenue!</h1>
    <?php 
        $d = $this->session->flashdata('error');
        if ($d != null){
            echo $d;
        } else {
            echo "Une erreur inconnue est survenue...";
        }
    ?>
    <?php $s = $this->session->flashdata('previous'); ?>
    <a href = "<?php if ($s != null){echo "#";} else echo base_url(); ?>" onclick="<?php if ($s != null){echo "javascript:window.history.back(-1);return false;";} ?>">
    <button class="btn btn-small">
        Go <?php 
        if ($s == null){
            echo "home";
        } else echo "back";
        ?>
    </button>
    </a>
</body>
</html>