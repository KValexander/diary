// Cells
let cells = {
	// Init
	init: function() {
		document.querySelectorAll("#out_cells .cell").forEach(elem => elem.addEventListener("click", event => popup.show_lb(event)));
		document.querySelectorAll("#popup #lb ul li").forEach(elem => {
			elem.addEventListener("click", () => {
				let size = document.getElementById("lb").getBoundingClientRect();
				document.querySelectorAll("#out_cells .cell").forEach(cell => {
					let cell_size = cell.getBoundingClientRect();
					if(parseInt(cell_size.x) == size.x && parseInt(cell_size.y + cell_size.height) == size.y)
						return cells.add(elem.id + cell.id);
				});
			});
		});
	},
	// Add cell
	add: function(id) {
		console.log(id);
	},
};