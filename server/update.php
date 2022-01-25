<?php
if(isset($_GET["t"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
	$type = $_GET["t"];
	$id = request("id");
	if(!is_numeric($id)) return response(400);
	switch($type) {
		case "profile":
			$name = htmlentities(trim(request("name")));
			$sql = sprintf("UPDATE `profiles` SET `name`='%s' WHERE `profile_id`='%s'", $connect->real_escape_string($name), $id);
		break;
		case "label":
			$label = trim(request("label"));
			$description = htmlentities(trim(request("description")));
			$sql = sprintf("UPDATE `labels` SET `label`='%s', `description`='%s' WHERE `label_id`='%s'",
				$connect->real_escape_string($label),
				$connect->real_escape_string($description),
				$id);
		break;
		case "hour":
			$hour = htmlentities(trim(request("hour")));
			$sql = sprintf("UPDATE `hours` SET `hour`='%s' WHERE `hour_id`='%s'", $connect->real_escape_string($hour), $id);
		break;
		case "date":
			$date = htmlentities(trim(request("date")));
			$sql = sprintf("UPDATE `dates` SET `date`='%s' WHERE `date_id`='%s'", $connect->real_escape_string($date), $id);
		break;
		default: return response(400); break;
	} if(!$connect->query($sql)) return response(400, $connect->error);
	if($type == "profile") $_SESSION["profile_name"] = $name;
	return response(200);
} else return response(400);