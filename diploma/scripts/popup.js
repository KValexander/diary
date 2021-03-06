// Popup
let popup = {
	timer: null,
	init: function() {
		popup.message = document.getElementById("message");
		popup.message.onclick = popup.hide_message;
		popup.lb = document.getElementById("lb");
	},
	// Out message
	show_message: function(content, time=3000) {
		popup.message.innerHTML = content;

		// Properties
		if(popup.message.clientHeight == 0) {
			popup.message.style.border = "solid 2px #333";
			popup.message.style.padding = "20px";
			height = popup.message.scrollHeight + 40;
			popup.message.style.height = `${height}px`;
		}

		clearTimeout(popup.timer);
		popup.timer = setTimeout(popup.hide_message, time);
	},
	// Hide popup
	hide_message: function() {
		popup.message.style.height = "0px";
		popup.message.style.border = "none";
		popup.message.style.padding = "0px";
	}
};

document.addEventListener("DOMContentLoaded", popup.init);