var path = "";

function loadTheme(myPath = null) {
	const themeCSS = document.getElementById("themeCSS");
    if (myPath!=null){
        path=myPath;
    }
	if(themeCSS) {
		themeCSS.href = path+localStorage.theme +".css";
	} else {
        if (!localStorage.theme){
            localStorage.theme = "colors";
        }
		const l = document.createElement("link");
		l.rel = "stylesheet";
		l.type = "text/css";
		l.media = "screen";
		l.href = path+localStorage.theme +".css"
		l.id = "themeCSS";
	
		document.head.appendChild(l);
	}
	
}

function changeTheme(e){
    if (e.target.checked) {
        localStorage.theme = "colors_dark";
    }
    else {
        localStorage.theme = "colors";
    }
    loadTheme();
}



