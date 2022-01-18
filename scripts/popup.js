// Popup
let popup = {
	init: function() {
		popup.message = document.getElementById("message");
		popup.message.onclick = popup.hide_message;
	},
	// Out message
	show_message: function(content, time=3000) {
		popup.message.innerHTML = content;

		popup.message.style.border = "solid 2px #333";
		popup.message.style.padding = "20px";
		height = popup.message.scrollHeight + 40;
		popup.message.style.height = `${height}px`;

		setTimeout(popup.hide_message, time);
	},
	// Hide popup
	hide_message: function() {
		popup.message.style.height = "0px";
		popup.message.style.border = "none";
		popup.message.style.padding = "0px";
	},
};

document.addEventListener("DOMContentLoaded", popup.init);