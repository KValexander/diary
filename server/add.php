<?php
if(isset($_GET["t"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
	$type = $_GET["t"];
	switch($type) {
		case "profile":
			$name = htmlentities(trim(request("name")));
			$sql = sprintf("INSERT INTO `profiles`(`name`) VALUES('%s')", $connect->real_escape_string($name));
		break;
		case "label":
			$label = trim(request("label"));
			$description = htmlentities(trim(request("description")));
			$sql = sprintf("INSERT INTO `labels`(`label`, `description`) VALUES('%s', '%s')",
				$connect->real_escape_string($label),
				$connect->real_escape_string($description));
		break;
		case "hour":
			$hour = htmlentities(trim(request("hour")));
			$sql = sprintf("INSERT INTO `hours`(`hour`) VALUES('%s')", $connect->real_escape_string($hour));
		break;
		case "date":
			$date = htmlentities(trim(request("date")));
			$sql = sprintf("INSERT INTO `dates`(`date`) VALUES('%s')", $connect->real_escape_string($date));
		break;
		default: return response(400); break;
	} if(!$connect->query($sql)) return response(400, $connect->error);
	return response(201);
} else return response(400);