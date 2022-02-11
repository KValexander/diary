let menu = {
	// Onload init
	init: function() {
		document.querySelector(".bar .left .point").addEventListener("click", menu.show);
		menu.main = document.querySelector("#menu .main");
		menu.side = document.querySelector("#menu .side");
		menu.close = document.querySelector("#menu .side #close");
		document.querySelector("#menu #hide").onclick = menu.hide;
	},
	// Show and Hide main menu
	show: function() {
		menu.main.style.width = "400px";
		menu.main.style.padding = "20px";
		mask.style.height = "100vh";
		mask.onclick = menu.hide;
		menu.main.style["border-right"] = "solid 5px #333";
		popup.hide_lb();
	},
	hide: function() {
		menu.main.style.width = "0px";
		menu.side.style.width = "0px";
		menu.main.style.padding = "0px";
		menu.side.style.padding = "0px";
		mask.style.height = "0px";
		menu.main.style["border-right"] = "none";
		menu.side.style["border-right"] = "none";
	},
	// Show and Hide side menu
	show_side: function(id) {
		document.querySelector("#menu .side #"+id).style.display = "block";
		menu.close.onclick = () => menu.hide_side(id);
		mask.onclick = () => menu.hide_side(id);
		menu.side.style.width = "600px";
		menu.side.style.padding = "20px";
		menu.side.style["border-right"] = "solid 5px #333";
	},
	hide_side: function(id) {
		document.querySelector("#menu .side #"+id).style.display = "none";
		mask.onclick = menu.hide;
		menu.side.style.width = "0px";
		menu.side.style.padding = "0px";
		menu.side.style["border-right"] = "none";
	},
};

document.addEventListener("DOMContentLoaded", menu.init);