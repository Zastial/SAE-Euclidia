<?php
if (isset($this->session->user["status"])) {
    $status = $this->session->user["status"];
} else {
    $status = "";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=<?= base_url("css/admin/admin.css") ?> >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Admin</title>
    
</head>
<body>
    
    <?php  require_once(APPPATH.'views/error.php'); ?>

    <?php require_once(APPPATH.'views/header.php'); ?> 

    <div class="page">
        
        <?php require_once(APPPATH.'views/admin/dashboard _component.php'); ?> 
      
        <!-- MAIN CONTENT -->
        <div class="main">
        </div>

        <button onclick="topFunction()" id="myBtn" ><img class="icon-up" src="<?=base_url("assets/icon/icon-arrow-down.svg")?>" alt=""></button>
    </div>


</body>
</html>


