<?php
if(isset($_GET["t"]) && isset($_GET["id"])) {
	$type = $_GET["t"];
	$id = $_GET["id"];
	switch($type) {
		case "profile":
			$sql = sprintf("DELETE FROM `profiles` WHERE `profile_id`='%s'", $id);
		break;
		case "label":
			$sql = sprintf("DELETE FROM `labels` WHERE `label_id`='%s'", $id);
		break;
		case "hour":
			$sql = sprintf("DELETE FROM `hours` WHERE `hour_id`='%s'", $id);
		break;
		case "date":
			$sql = sprintf("DELETE FROM `dates` WHERE `date_id`='%s'", $id);
		break;
		default: return response(400); break;
	}
	if(!$connect->query($sql)) return response(400, $connect->error);
	else return response(201);
} else return response(400);