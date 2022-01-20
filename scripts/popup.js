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
	},
	// Show lb
	show_lb: function(event) {
		// Variables
		let elem = event.target;
		let id = elem.id;
		let bound = elem.getBoundingClientRect();

		// Sides
		let left = parseInt(bound.x);
		let top = bound.y + bound.height;

		// Hiding when clicking the same cell again
		if(popup.lb.clientHeight != 0 && popup.lb.style.top == `${top}px` && popup.lb.style.left == `${left}px`)
			return popup.hide_lb()

		// Properties
		popup.lb.style.left = `${left}px`;
		popup.lb.style.top = `${top}px`;
		popup.lb.style.padding = `20px`;
		popup.lb.style.border = "solid 1px black";
		// popup.lb.style.width = `${bound.width}px`;
		if(popup.lb.clientHeight == 0)
			popup.lb.style.height = `${popup.lb.scrollHeight + 40}px`;
	},
	// Hide lb
	hide_lb: function() {
		popup.lb.style.padding = "0px";
		popup.lb.style.height = "0px";
		popup.lb.style.border = "none";
	},
};

document.addEventListener("DOMContentLoaded", popup.init);