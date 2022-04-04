// Cells
let cells = {
	// Init
	init: function() {
		document.querySelectorAll("#out_cells .cell").forEach(elem => elem.addEventListener("click", event => {
			cells.show_labels(event);
		}));
	},
	// Show labels
	show_labels: function(e) {
		let elem = e.target, id = e.id;

		if(elem.localName == "li") return cells.click_li(e);
		else if(elem.classList.contains('labels'))
			return cells.hide_labels(elem, e.path[1]);
		else if(elem.classList.contains('label')) elem = e.path[1];

		let labels = elem.querySelector(".labels");
		if(labels.style.display == "block")
			return cells.hide_labels(labels, elem);

		elem.querySelector(".label").style.display = "none";
		elem.style["align-items"] = "start";

		script.get(data => {
			labels.style.display = "block";
			labels.style.padding = "10px 20px";
			labels.style.height = "auto";

			out = "<ul>";
			if(data.data.length)
				data.data.forEach(label => out += `<li id="l${label[0]}-">${label[1]}</li>`);
			out += "</ul>";
			
			labels.innerHTML = out;

		}, "/get?t=label");
	},
	// Hide labels
	hide_labels: function(labels, parent) {
		parent.style["align-items"] = "center";
		parent.querySelector(".label").style.display = "block";
		labels.innerHTML = "";
		labels.style.display = "none";
		labels.style.padding = "0px";
		labels.style.height = "0px";
	},
	// Click li
	click_li: function(e) {
		let li = e.target, parent = e.path[3];
		parent.style["align-items"] = "center";
		cells.hide_labels(e.path[2], parent);

		cells.add(li.id + parent.id + "-" + li.innerText);
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
			elem = document.getElementById(id[1]+"-"+id[2]);
			elem.querySelector(".label").innerHTML = data.data.label;
			elem.title = data.data.description;
			elem.ondblclick = () => cells.delete(`${id[1]}-${id[2]}`);
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
			document.querySelector(`#${id[0]}-${id[1]} .label`).innerHTML = "";
		}, "/cell?t=delete", json);
	}
};