<?php
if(isset($_GET["t"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

	$type = $_GET["t"];

	$profile_id = (isset($_SESSION["profile_id"])) ? $_SESSION["profile_id"] : 0;
	$hour_id = request("hour_id");
	$date_id = request("date_id");
	$label_id = request("label_id");

	// Exists
	$sql = sprintf($arr_sql["cell_id"], $_SESSION["user_id"], $profile_id, $hour_id, $date_id);
	$result = $connect->query($sql);
	if(!$result) die("Error: ". $connect->error);
	if($cell_id = $result->fetch_array()[0])
		$type = ($type == "delete") ? "delete" : "update";

	switch($type) {
		case "add":
			$sql = sprintf($arr_sql["cell_add"], $_SESSION["user_id"], $profile_id, $hour_id, $date_id, $label_id);
			$status = 201;
		break;
		case "update":
			$sql = sprintf($arr_sql["cell_update"], $_SESSION["user_id"], $profile_id, $hour_id, $date_id, $label_id, $cell_id);
			$status = 200;
		break;
		case "delete":
			$sql = sprintf($arr_sql["cell_delete"], $_SESSION["user_id"], $cell_id);
			$status = 200;
		break;
		default: return response(400); break;
	}

	if(!$connect->query($sql)) return response(400, $connect->error);

	return response($status, $connect->query(sprintf($arr_sql["cell_label"], $_SESSION["user_id"], $label_id))->fetch_assoc());

} else return response(400);