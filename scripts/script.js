let mask;
document.addEventListener("DOMContentLoaded", function() {
	mask = document.getElementById("mask");
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
};

// Labels
let labels = {
	add: function() {
		let form = document.forms["add_label"];
		console.log(form.elements[2].value == "");
		let json = JSON.stringify({
			"label": form.elements[0].value,
			"description": form.elements[2].value,
		});
		script.post(data => {
			popup.show_message("Label added");
			form.elements[0].value = "";
			form.elements[2].value = "";
		}, "/add?t=label", json);
		return false;
	},
};

// Profiles
let profiles = {
	add: function() {
		let form = document.forms["add_profile"];
		let json = JSON.stringify({"name": form.elements[0].value});
		script.post(data => {
			popup.show_message("Profile added");
			form.elements[0].value = "";
		}, "/add?t=profile", json);
		return false;
	},
};

// Hours
let hours = {
	add: function() {
		let form = document.forms["add_hour"];
		let json = JSON.stringify({"hour": form.elements[0].value});
		script.post(data => {
			popup.show_message("Hour added");
			form.elements[0].value = "";
		}, "/add?t=hour", json);
		return false;
	},
};

// Dates
let dates = {
	add: function() {
		let form = document.forms["add_date"];
		let json = JSON.stringify({"date": form.elements[0].value});
		script.post(data => {
			popup.show_message("Date added");
			form.elements[0].value = "";
		}, "/add?t=date", json);
		return false;
	},
};