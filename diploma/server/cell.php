<?php
if(isset($_GET["t"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

	$type = $_GET["t"];

	$profile_id = (isset($_SESSION["profile_id"])) ? $_SESSION["profile_id"] : 0;
	$hour_id = request("hour_id");
	$date_id = request("date_id");
	$note = request("note");

	// Exists
	$sql = sprintf($arr_sql["cell_id"], $profile_id, $hour_id, $date_id);
	$result = $connect->query($sql);
	if(!$result) die("Error: ". $connect->error);
	if($cell_id = $result->fetch_array()[0])
		$type = ($type == "delete") ? "delete" : "update";

	switch($type) {
		case "add":
			$sql = sprintf($arr_sql["cell_add_note"], $profile_id, $hour_id, $date_id, $note);
			$status = 201;
		break;
		case "update":
			$sql = sprintf($arr_sql["cell_update"], $profile_id, $hour_id, $date_id, $note, $cell_id);
			$status = 200;
		break;
		case "delete":
			$sql = sprintf($arr_sql["cell_delete"], $cell_id);
			$status = 202;
		break;
		default: return response(400); break;
	}

	if(!$connect->query($sql)) return response(400, $connect->error);

	return response($status, $connect->query(sprintf($arr_sql["cell_label"], $label_id))->fetch_assoc());

} else return response(400);