// on vérifie si 'darkMode' est dans le localStorage
let darkMode = localStorage.getItem('darkMode');


const darkModeToggle = document.querySelector('#dark-mode-toggle');
const logo = document.querySelector("#euclidia-icon-header");

const enableDarkMode = () => {
    // 1. ajout de la classe au body
    document.body.classList.add('darkmode');
    // 2. Mise a jour de darkMode dans le localstorage
    localStorage.setItem('darkMode', 'enabled');
    // 3. Changement de l'icone
    if (logo != null)logo.setAttribute("src", "/assets/image/logo_euclidia_white.svg");
}

const disableDarkMode = () => {
    // 1. suppression de la classe du body
    document.body.classList.remove('darkmode');
    // 2. Mise a jour de darkMode dans le localstorage
    localStorage.setItem('darkMode', null);
    // 3. Changement de l'icone
    if (logo != null)logo.setAttribute("src", "/assets/image/logo_euclidia.svg");
}

// Si l'utilisateur a déjà visité la page avec le dark mode
// On peut l'activer directement
if (darkMode === 'enabled') {
    enableDarkMode();
    if (document.getElementById("checkbox-switcher")!=null)document.getElementById("checkbox-switcher").checked = true;
}
if (darkModeToggle!=null){
    // Quand on appuie sur le bouton
    darkModeToggle.addEventListener('click', () => {
        
        // on prend darkMode de localstorage
        darkMode = localStorage.getItem('darkMode');
    
        // si il n'est pas activé, on l'active
        if (darkMode !== 'enabled') {
            enableDarkMode();
            // sinon, on le désactive  
        } else {
            disableDarkMode();
        }
    });
}