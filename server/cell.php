<?php
if(isset($_GET["t"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

	$type = $_GET["t"];

	$profile_id = (isset($_SESSION["profile_id"])) ? $_SESSION["profile_id"] : 0;
	$hour_id = request("hour_id");
	$date_id = request("date_id");
	$label_id = request("label_id");

	// Exists
	$sql = sprintf("SELECT `cell_id` FROM `cells` WHERE `profile_id`='%s' AND `hour_id`='%s' AND `date_id`='%s'",
	$profile_id, $hour_id, $date_id);
	$result = $connect->query($sql);
	if(!$result) die("Error: ". $connect->error);
	if($cell_id = $result->fetch_array()[0])
		$type = "update";

	switch($type) {
		case "add":
			$sql = sprintf("INSERT INTO `cells`(`profile_id`, `hour_id`, `date_id`, `label_id`) VALUES('%s', '%s', '%s', '%s')",
				$profile_id, $hour_id, $date_id, $label_id
			); $status = 201;
		break;
		case "update":
			$sql = sprintf("UPDATE `cells` SET `profile_id`='%s',`hour_id`='%s',`date_id`='%s',`label_id`='%s' WHERE `cell_id`='%s'",
				$profile_id, $hour_id, $date_id, $label_id, $cell_id
			); $status = 200;
		break;
		case "delete":
			$cell_id = request("cell_id");
			if($cell_id == NULL) return response(400);
			$sql = sprintf("DELETE FROM `cells` WHERE `cell_id`='%s'", $cell_id);
			$status = 200;
		break;
		default: return response(400); break;
	}

	if(!$connect->query($sql)) return response(400, $connect->error);

	return response($status);

} else return response(400);