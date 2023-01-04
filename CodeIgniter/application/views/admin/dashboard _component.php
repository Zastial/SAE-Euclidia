<?php
if (!isset($active)) {
    $active = "";
}
if (isset($this->session->user["status"])) {
    $status = $this->session->user["status"];
} else {
    $status = "";
}
?>

<div class="side-bar">
    <h1>Tables</h1>
    <div class="side-bar-container">
        <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
            <a href=<?=site_url('admin/products')?> >
                <div class="table <?php if ($active == "products") {echo 'active';}?>">
                    <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                    <p>Produits</p>
                </div>
            </a>
        <?php endif; ?>   

        <?php if ($status == "Administrateur"): ?>
            <a href=<?=site_url('admin/users')?> >
            <div class="table <?php if ($active == "users") {echo 'active';}?>">
                    <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                    <p>Utilisateurs</p>
                </div>
            </a>
        <?php endif; ?>

        <?php if ($status == "Responsable" || $status == "Administrateur"): ?>
            <a href=<?=site_url('admin/categories')?> >
            <div class="table <?php if ($active == "categories") {echo 'active';}?>">
                    <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                    <p>Catégories</p>
                </div>
            </a>
        <?php endif; ?>

        <?php if ($status == "Administrateur"): ?>
                <a href=<?=site_url('admin/factures')?> >
                <div class="table <?php if ($active == "factures") {echo 'active';}?>">
                        <img class="icon-side-bar" src="<?= base_url("assets/icon/icon-rect.svg"); ?>" alt="">
                        <p>Factures</p>
                    </div>
                </a>
        <?php endif; ?>

        
    </div>
    
</div>



