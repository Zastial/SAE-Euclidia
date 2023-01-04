// check for saved 'darkMode' in localStorage
let darkMode = localStorage.getItem('darkMode');


const darkModeToggle = document.querySelector('#dark-mode-toggle');
const logo = document.querySelector("#euclidia-icon-header");

const enableDarkMode = () => {
    // 1. Add the class to the body
    document.body.classList.add('darkmode');
    // 2. Update darkMode in localStorage
    localStorage.setItem('darkMode', 'enabled');
    // 3. Change the icon
    if (logo != null)logo.setAttribute("src", "/assets/image/logo_euclidia_white.svg");
}

const disableDarkMode = () => {
    // 1. Remove the class from the body
    document.body.classList.remove('darkmode');
    // 2. Update darkMode in localStorage 
    localStorage.setItem('darkMode', null);
    // 3. Change the icon
    if (logo != null)logo.setAttribute("src", "/assets/image/logo_euclidia.svg");
}

// If the user already visited and enabled darkMode
// start things off with it on
if (darkMode === 'enabled') {
    enableDarkMode();
    if (document.getElementById("checkbox-switcher")!=null)document.getElementById("checkbox-switcher").checked = true;
}
if (darkModeToggle!=null){
    // When someone clicks the button
    darkModeToggle.addEventListener('click', () => {
        
        // get their darkMode setting
        darkMode = localStorage.getItem('darkMode');
    
        // if it not current enabled, enable it
        if (darkMode !== 'enabled') {
            enableDarkMode();
            // if it has been enabled, turn it off  
        } else {
            disableDarkMode();
        }
    });
}