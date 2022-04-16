// Cells
let cells = {
	// Init
	init: function() {
		document.querySelectorAll("#out_cells .cell").forEach(elem => elem.addEventListener("click", event => {
			cells.show_note(event);
		}));
	},
	// Show note
	show_note: function(e) {
		let elem = e.target, id = e.id;

		if(elem.localName == "textarea") return;
		else if(elem.classList.contains("note"))
			elem = elem.parentNode
		let textarea = elem.querySelector("textarea");
		// console.log(elem);

		if(elem.classList.contains("active")) {
			elem.classList.remove("active");
			elem.style["background-color"] = "";
			textarea.style.display = "none";
			cells.add(elem.id, textarea.value);
		} else {
			cells.hide_note();
			elem.classList.add("active");
			elem.style["background-color"] = "#ccc";
			textarea.style.display = "block";
		}

	},
	// Hide note
	hide_note: function() {
		document.querySelectorAll("div.app div.bar div.right div.bottom div.cell").forEach(el => {
			el.classList.remove("active");
			el.querySelector("textarea").style.display = "none";
			el.style["background-color"] = "";
		});
	},
	// Add note
	add: function(id, note) {
		if(!note) return;
		id = id.split("-");
		json = JSON.stringify({
			"date_id":  id[0].slice(1),
			"hour_id":  id[1].slice(1),
			"note":  note,
		});
		script.post(data => {
			if(data.status == 200) popup.show_message("Cell is updated");
			else if(data.status == 201) popup.show_message("Cell is added");
			elem = document.getElementById(id[0]+"-"+id[1]);
			elem.querySelector(".note").innerHTML = "N";
			elem.querySelector("textarea").value = note;
			elem.oncontextmenu = () => cells.delete(`${id[0]}-${id[1]}`);
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
			cells.hide_note();
			document.getElementById(id[0]+"-"+id[1]).oncontextmenu = null;
			document.querySelector(`#${id[0]}-${id[1]} .note`).innerHTML = "";
			document.querySelector(`#${id[0]}-${id[1]} textarea`).value = "";
		}, "/cell?t=delete", json);
	}
};