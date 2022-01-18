let mask;
window.onload = () => mask = document.getElementById("mask");

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
		}; script.xhr.send(data);
	},
};

