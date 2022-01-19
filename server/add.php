<?php
if(isset($_GET["t"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
	$type = $_GET["t"];
	switch($type) {
		case "profile":
			$table = "profiles";
			$name = htmlentities(trim(request("name")));
			$sql = sprintf("INSERT INTO `%s`(`name`) VALUES('%s')", $table, $connect->real_escape_string($name));
		break;
		case "label":
			$table = "labels";
			$label = htmlentities(trim(request("label")));
			$description = htmlentities(trim(request("description")));
			$sql = sprintf("INSERT INTO `%s`(`label`, `description`) VALUES('%s', '%s')",
				$table,
				$connect->real_escape_string($label),
				$connect->real_escape_string($description));
		break;
		case "hour":
			$table = "hours";
			$hour = htmlentities(trim(request("hour")));
			$sql = sprintf("INSERT INTO `%s`(`hour`) VALUES('%s')", $table, $connect->real_escape_string($hour));
		break;
		case "date":
			$table = "dates";
			$date = htmlentities(trim(request("date")));
			$sql = sprintf("INSERT INTO `%s`(`date`) VALUES('%s')", $table, $connect->real_escape_string($date));
		break;
		default: return response(400); break;
	}
	if(!$connect->query($sql)) return response(400, $connect->error);
	return response(201);
} else return response(400);