// Cells
let cells = {
	// Init
	init: function() {
		document.querySelectorAll("#out_cells .cell").forEach(elem => {
			elem.addEventListener("click", event => popup.show_lb(event));
		});
	},
};