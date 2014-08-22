function activemenu() {

		var simplemenu = document.getElementById("simple-menu");

		if(simplemenu.className == "activemenu") {
			simplemenu.className = "";
		} else {
			simplemenu.className = "activemenu";
		}


	}



		var CurrentPage = "index";
		var idMenuCurrent = "home";

		function DisplayPages(id, idMenu) {


			document.getElementById(CurrentPage).style.left = "-99999px";
			document.getElementById(CurrentPage).style.position = "absolute";
			if (idMenuCurrent) {document.getElementById(idMenuCurrent).className= "";}

			document.getElementById(id).style.left = "auto";
			document.getElementById(id).style.position = "static";
			if (idMenu) {document.getElementById(idMenu).className= "active";}

			CurrentPage = id;
			if (idMenu) {idMenuCurrent = idMenu;} else {idMenuCurrent= "";}


		}
