let mask;
document.addEventListener("DOMContentLoaded", function() {
	mask = document.getElementById("mask");
	// Check date
	script.get(data => {
		if(data.status == 201) popup.show_message("Today's date added", 5000)
		// INIT
		script.refresh(() => {
			labels.init();
			profiles.init();
			hours.init();
			dates.init();
		});
	}, "/check");
});

// Script
let script = {
	xhr: new XMLHttpRequest(),
	// Get request
	get: function(callback, url, data=null) {
		script.xhr.open("GET", url, true);
		script.xhr.onreadystatechange = function() {
			if(script.xhr.readyState != 4) return;
			callback(JSON.parse(script.xhr.responseText));
		}; script.xhr.send(data);
	},
	// Post request
	post: function(callback, url, data=null) {
		script.xhr.open("POST", url, true);
		script.xhr.setRequestHeader("Content-Type", "application/json");
		script.xhr.onreadystatechange = function() {
			if(script.xhr.readyState != 4) return;
			callback(JSON.parse(script.xhr.responseText));
		};
		script.xhr.send(data);
	},
	// Refreshing page data
	refresh: function(callback=null) {
		script.get(data => {
			let status = data.status, lb = "";
			data = data.data;

			// Current profile
			document.getElementById("current_profile").innerHTML = data.current_profile;

			// Out select data
			select = document.querySelectorAll(".select_profiles");
			select.forEach(elem => elem.innerHTML = `<option disabled selected value="null">Profiles</option>`);
			select.forEach(elem => elem.innerHTML += data.select_out.profiles);

			select = document.querySelectorAll(".select_labels");
			select.forEach(elem => elem.innerHTML = `<option disabled selected value="null">Labels</option>`);
			select.forEach(elem => elem.innerHTML += data.select_out.labels);

			select = document.querySelectorAll(".select_dates");
			select.forEach(elem => elem.innerHTML = `<option disabled selected value="null">Dates</option>`);
			select.forEach(elem => elem.innerHTML += data.select_out.dates);

			select = document.querySelectorAll(".select_hours");
			select.forEach(elem => elem.innerHTML = `<option disabled selected value="null">Hours</option>`);
			select.forEach(elem => elem.innerHTML += data.select_out.hours);
			
			data.data.labels.forEach(label => lb += `<li id="l${label[0]}-">${label[1]}</li>`);
			
			// Out data
			document.getElementById("out_labels").innerHTML = (data.out.labels) ? data.out.labels : "<li>No labels</li>";
			document.getElementById("out_dates").innerHTML = (data.out.dates) ? data.out.dates : "";
			document.getElementById("out_hours").innerHTML = (data.out.hours) ? data.out.hours : "";
			document.getElementById("out_cells").innerHTML = (data.out.cells) ? data.out.cells : "";

			// Out cells
			data.data.cells.forEach(cell => {
				elem = document.getElementById(`d${cell[4]}-h${cell[3]}`);
				elem.title = cell[10]; elem.querySelector(".label").innerHTML = cell[9];
				elem.ondblclick = () => cells.delete(`d${cell[4]}-h${cell[3]}`);
			});

			// Callback if necessary
			if(callback != null) callback();
			cells.init();
		}, "/refresh");
	},
};

// Labels
let labels = {
	init: function() {
		labels.form = document.forms["labels_form"];
		labels.head = document.getElementById("head_labels_form");
	},
	// Add label
	add: function() {
		let json = JSON.stringify({
			"label": labels.form.elements[0].value,
			"description": labels.form.elements[2].value,
		});
		script.post(data => {
			popup.show_message("Label added");
			labels.form.elements[0].value = "";
			labels.form.elements[2].value = "";
			script.refresh();
		}, "/add?t=label", json);
		return false;
	},
	// Actions label
	actions: function(event) {
		event.preventDefault();

		let id = event.target.elements[0].value;
		if(id == "null") return false;
		let type = event.submitter.value;

		// Delete
		if(type == "delete") {
			let check = confirm("Are you sure you want to delete this entry?");
			if(check) {
				script.get(data => {
					popup.show_message("Label deleted");
					script.refresh();
				}, "/delete?t=label&id="+id);
			}
		}

		// Update
		else if(type == "update") {
			labels.form.onsubmit = () => { return labels.update(labels.form) };
			
			script.get(data => {
				labels.form.elements[0].value = data.data.label;
				labels.form.elements[1].value = data.data.label_id;
				labels.form.elements[2].value = data.data.description;
			}, "/get?t=label&id="+id);

			labels.head.innerHTML = "Update label";
			labels.form.elements[1].innerHTML = "Update";
		}

		return false;
	},
	// Update label
	update: function(form) {
		let json = JSON.stringify({
			"id": form.elements[1].value,
			"label": form.elements[0].value,
			"description": form.elements[2].value,
		});

		script.post(data => {
			popup.show_message("Label updated");

			form.onsubmit = () => { return labels.add() };

			form.elements[0].value = "";
			form.elements[1].value = "";
			form.elements[2].value = "";

			labels.head.innerHTML = "Add label";
			form.elements[1].innerHTML = "Add";

			script.refresh();
		}, "/update?t=label", json);

		return false;
	},
};

// Profiles
let profiles = {
	init: function() {
		profiles.form = document.forms["profiles_form"];
		profiles.head = document.getElementById("head_profiles_form");
	},
	// Select current profile
	select: function(event) {
		event.preventDefault();

		let id = event.target.elements[0].value;
		if(id == "null") return false;

		script.get(data => {
			if(data.status == 400) return popup.show_message(data.data);
			popup.show_message(`Profile "${data.data}" is selected`);
			script.refresh();
		}, "/select?t=select&profile_id="+id);

		return false;
	},
	// Deselect profile
	deselect: function() {
		script.get(data => {
			popup.show_message("You are logged out");
			script.refresh();
		}, "/select?t=deselect");
		return false;
	},
	// Add profile
	add: function() {
		let json = JSON.stringify({"name": profiles.form.elements[0].value});

		script.post(data => {
			popup.show_message("Profile added");
			profiles.form.elements[0].value = "";
			script.refresh();
		}, "/add?t=profile", json);

		return false;
	},
	// Actions profile
	actions: function(event) {
		event.preventDefault();

		let id = event.target.elements[0].value;
		if(id == "null") return false;
		let type = event.submitter.value;

		// Delete
		if(type == "delete") {
			let check = confirm("Are you sure you want to delete this entry?");
			if(check) {
				script.get(data => {
					popup.show_message("Profile deleted");
					script.refresh();
				}, "/delete?t=profile&id="+id);
			}
		}

		// Update
		else if(type == "update") {
			profiles.form.onsubmit = () => { return profiles.update(profiles.form) };
			
			script.get(data => {
				profiles.form.elements[0].value = data.data.name;
				profiles.form.elements[1].value = data.data.profile_id;
			}, "/get?t=profile&id="+id);

			profiles.head.innerHTML = "Update profile";
			profiles.form.elements[1].innerHTML = "Update";
		}

		return false;
	},
	// Update profile
	update: function(form) {
		let json = JSON.stringify({
			"id": form.elements[1].value,
			"name": form.elements[0].value
		});

		script.post(data => {
			popup.show_message("Profile updated");

			form.onsubmit = () => { return profiles.add() };

			form.elements[0].value = "";
			form.elements[1].value = "";

			profiles.head.innerHTML = "Add profile";
			form.elements[1].innerHTML = "Add";

			script.refresh();
		}, "/update?t=profile", json);

		return false;
	},
};

// Hours
let hours = {
	init: function() {
		hours.form = document.forms["hours_form"];
		hours.head = document.getElementById("head_hours_form");
	},
	// Add hour
	add: function() {
		let json = JSON.stringify({"hour": hours.form.elements[0].value});

		script.post(data => {
			popup.show_message("Hour added");
			hours.form.elements[0].value = "";
			script.refresh();
		}, "/add?t=hour", json);

		return false;
	},
	// Actions hours
	actions: function(event) {
		event.preventDefault();

		let id = event.target.elements[0].value;
		if(id == "null") return false;
		let type = event.submitter.value;

		// Delete
		if(type == "delete") {
			let check = confirm("Are you sure you want to delete this entry?");
			if(check) {
				script.get(data => {
					popup.show_message("Hour deleted");
					script.refresh();
				}, "/delete?t=hour&id="+id);
			}
		}

		// Update
		else if(type == "update") {
			hours.form.onsubmit = () => { return hours.update(hours.form) };
			
			script.get(data => {
				hours.form.elements[0].value = data.data.hour;
				hours.form.elements[1].value = data.data.hour_id;
			}, "/get?t=hour&id="+id);

			hours.head.innerHTML = "Update hour";
			hours.form.elements[1].innerHTML = "Update";
		}

		return false;
	},
	// Update hour
	update: function(form) {
		let json = JSON.stringify({
			"id": form.elements[1].value,
			"hour": form.elements[0].value
		});

		script.post(data => {
			popup.show_message("Hour updated");

			form.onsubmit = () => { return hours.add() };

			form.elements[0].value = "";
			form.elements[1].value = "";

			hours.head.innerHTML = "Add hour";
			form.elements[1].innerHTML = "Add";

			script.refresh();
		}, "/update?t=hour", json);

		return false;
	},
};

// Dates
let dates = {
	init: function() {
		dates.form = document.forms["dates_form"];
		dates.head = document.getElementById("head_dates_form");
	},
	// Add date
	add: function() {
		let json = JSON.stringify({"date": dates.form.elements[0].value});

		script.post(data => {
			popup.show_message("Date added");
			dates.form.elements[0].value = "";
			script.refresh();
		}, "/add?t=date", json);

		return false;
	},
	// Actions dates
	actions: function(event) {
		event.preventDefault();

		let id = event.target.elements[0].value;
		if(id == "null") return false;
		let type = event.submitter.value;

		// Delete
		if(type == "delete") {
			let check = confirm("Are you sure you want to delete this entry?");
			if(check) {
				script.get(data => {
					popup.show_message("Date deleted");
					script.refresh();
				}, "/delete?t=date&id="+id);
			}
		}

		// Update
		else if(type == "update") {
			dates.form.onsubmit = () => { return dates.update(dates.form) };
			
			script.get(data => {
				dates.form.elements[0].value = data.data.date;
				dates.form.elements[1].value = data.data.date_id;
			}, "/get?t=date&id="+id);

			dates.head.innerHTML = "Update date";
			dates.form.elements[1].innerHTML = "Update";
		}

		return false;
	},
	// Update date
	update: function(form) {
		let json = JSON.stringify({
			"id": form.elements[1].value,
			"date": form.elements[0].value
		});

		script.post(data => {
			popup.show_message("Date updated");

			form.onsubmit = () => { return dates.add() };

			form.elements[0].value = "";
			form.elements[1].value = "";

			dates.head.innerHTML = "Add date";
			form.elements[1].innerHTML = "Add";

			script.refresh();
		}, "/update?t=date", json);

		return false;
	},
};