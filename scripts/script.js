let mask;
document.addEventListener("DOMContentLoaded", function() {
	mask = document.getElementById("mask");
	script.update();
});

// Script
let script = {
	xhr: new XMLHttpRequest(),
	get: function(callback, url, data=null) {
		script.xhr.open("GET", url, true);
		script.xhr.onreadystatechange = function() {
			if(script.xhr.readyState != 4) return;
			callback(JSON.parse(script.xhr.responseText));
		}; script.xhr.send(data);
	},
	post: function(callback, url, data=null) {
		script.xhr.open("POST", url, true);
		script.xhr.setRequestHeader("Content-Type", "application/json");
		script.xhr.onreadystatechange = function() {
			if(script.xhr.readyState != 4) return;
			callback(JSON.parse(script.xhr.responseText));
		};
		script.xhr.send(data);
	},
	update: function() {
		script.get(data => {
			status = data.status;
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
			
			// Out data
			document.getElementById("out_labels").innerHTML = (data.out.labels) ? data.out.labels : "";
			document.getElementById("out_dates").innerHTML = (data.out.dates) ? data.out.dates : "";
			document.getElementById("out_hours").innerHTML = (data.out.hours) ? data.out.hours : "";
			document.getElementById("out_cells").innerHTML = (data.out.cells) ? data.out.cells : "";
		}, "/update");
	},
};

// Labels
let labels = {
	// Add label
	add: function(event) {
		event.preventDefault();

		let form = event.target;
		let json = JSON.stringify({
			"label": form.elements[0].value,
			"description": form.elements[2].value,
		});
		script.post(data => {
			popup.show_message("Label added");
			form.elements[0].value = "";
			form.elements[2].value = "";
			script.update();
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
					script.update();
				}, "/delete?t=label&id="+id);
			}
		}

		return false;
	}
};

// Profiles
let profiles = {
	// Select current profile
	select: function(event) {
		event.preventDefault();

		let id = event.target.elements[0].value;
		if(id == "null") return false;

		script.get(data => {
			if(data.status == 400) popup.show_message(data.data);
			else {
				document.getElementById("current_profile").innerHTML = data.data;
				popup.show_message(`Profile "${data.data}" is selected`);
			}
		}, "/select?profile_id="+id);

		return false;
	},
	// Add profile
	add: function(event) {
		event.preventDefault();

		let form = event.target;
		let json = JSON.stringify({"name": form.elements[0].value});

		script.post(data => {
			popup.show_message("Profile added");
			form.elements[0].value = "";
			script.update();
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
					script.update();
				}, "/delete?t=profile&id="+id);
			}
		}

		return false;
	},
};

// Hours
let hours = {
	// Add hour
	add: function(event) {
		event.preventDefault();

		let form = event.target;
		let json = JSON.stringify({"hour": form.elements[0].value});

		script.post(data => {
			popup.show_message("Hour added");
			form.elements[0].value = "";
			script.update();
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
					script.update();
				}, "/delete?t=hour&id="+id);
			}
		}

		return false;
	},
};

// Dates
let dates = {
	// Add date
	add: function(event) {
		event.preventDefault();

		let form = event.target;
		let json = JSON.stringify({"date": form.elements[0].value});

		script.post(data => {
			popup.show_message("Date added");
			form.elements[0].value = "";
			script.update();
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
					script.update();
				}, "/delete?t=date&id="+id);
			}
		}

		return false;
	},
};