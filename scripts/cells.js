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
						return cells.add(elem.id + cell.id + "-" + elem.innerText);
				});
			});
		});
	},
	// Add cell
	add: function(id) {
		id = id.split("-");
		json = JSON.stringify({
			"label_id":  id[0].slice(1),
			"date_id":  id[1].slice(1),
			"hour_id":  id[2].slice(1),
		});
		script.post(data => {
			if(data.status == 200)popup.show_message("Cell is updated");
			else if(data.status == 201)popup.show_message("Cell is added");
			document.getElementById(id[1]+"-"+id[2]).innerHTML = id[3];
			document.getElementById(id[1]+"-"+id[2]).ondblclick = () => cells.delete(id[1]+"-"+id[2]);
			popup.hide_lb();
		}, "/cell?t=add", json);
	},
	// Delete cell
	delete: function(id) {
		id = id.split("-");
		json = JSON.stringify({
			"date_id":  id[0].slice(1),
			"hour_id":  id[1].slice(1),
		});
		script.post(data => {
			popup.show_message("Cell is deleted");
			document.getElementById(id[0]+"-"+id[1]).innerHTML = "";
		}, "/cell?t=delete", json);
	}
};