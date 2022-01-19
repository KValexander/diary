<?php
if(isset($_GET["t"])) {
	$type = $_GET["t"];
	$id = (isset($_GET["id"])) ? $_GET["id"] : NULL;
	switch($type) {
		case "profile":
			$sql = "SELECT * FROM `profiles`";
			if($id != NULL) $sql .= sprintf(" WHERE `profile_id`='%s'", $id);
			$sql .= " ORDER BY `profile_id` ASC";
		break;
		case "label":
			$sql = "SELECT * FROM `labels`";
			if($id != NULL) $sql .= sprintf(" WHERE `label_id`='%s'", $id);
			$sql .= " ORDER BY `label_id` ASC";
		break;
		case "hour":
			$sql = "SELECT * FROM `hours`";
			if($id != NULL) $sql .= sprintf(" WHERE `hour_id`='%s'", $id);
			$sql .= " ORDER BY `hour` ASC";
		break;
		case "date":
			$sql = "SELECT * FROM `dates`";
			if($id != NULL) $sql .= sprintf(" WHERE `date_id`='%s'", $id);
			$sql .= " ORDER BY `date` DESC";
		break;
		default: return response(400); break;
	}
	$result = $connect->query($sql);
	if($result) {
		$data = ($id == NULL) ? $result->fetch_all() : $result->fetch_assoc(); 
		return response(200, $data);	
	};
	return response(400, $connect->error);
} else return response(400);