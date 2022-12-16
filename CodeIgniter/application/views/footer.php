<head>

    <link rel="stylesheet" href= <?= base_url("css/typographie.css") ?>>
    <link rel="stylesheet" href= <?= base_url("css/components.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/style.css") ?>>
    <link rel="stylesheet" href=<?= base_url("css/footer.css") ?>>
    <script src="<?=base_url("js/theme.js")?>"></script>
    <script>
        if (!localStorage.theme){
            localStorage.theme = "colors";
        }
        const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
        if (localStorage.theme=="colors_dark"){
            toggleSwitch.checked = true;
        }
        loadTheme('<?=base_url('css/')?>');
        toggleSwitch.addEventListener('change', changeTheme, false);
    </script>
 </head>

<footer>
  

    <div class="redirection">
        
            <a href=<?= site_url("Home") ?>>Home</a>
            <a href=<?= site_url("Product/find") ?>>Services</a>
            <a href=<?= site_url("Contact") ?>>Contact</a>
            <a href=<?=base_url("User/account")?>>Compte</a>
        
    </div>

    <p class="copyright">Copyright © 2022</p>


</footer>

